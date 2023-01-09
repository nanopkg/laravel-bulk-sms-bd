<?php

namespace Nanopkg\BulkSmsBd;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

/**
 * Class BulkSmsBd
 *
 * @method BulkSmsBd oneToOne(string $contacts,string $msg,string $type = 'text')
 * @method BulkSmsBd oneToMany(array $contacts,string $msg,string $type = 'text')
 * @method BulkSmsBd manyToMany(array $contacts)
 * @method BulkSmsBd getBalance()
 * @method BulkSmsBd send()
 *
 * @example getBalance();
 * @example BulkSmsBd::oneToOne('88017xxxxxxxx', 'message')->send();
 * @example BulkSmsBd::oneToMany(['88017xxxxxxxx','88018xxxxxxxx'], 'message', 'text')->send();
 * @example BulkSmsBd::manyToMany([['to'=>'88017xxxxxxxx','message'=>'message1'],['to'=>'88018xxxxxxxx','message'=>'message2']])->send();
 *
 * @author IQBAL HASAN <iqbalhasan.dev@gmail.com>
 *
 * @link https://iqbalhasan.dev Author Homepage
 *
 * @license LICENSE The MIT License
 */
class BulkSmsBd
{
    public function __construct()
    {
        // Check if api key and sender id is set
        if ($this->mode() != 'log' && ($this->apiKey() == '' || $this->senderID() == '')) {
            throw  new \Exception('Api Key Or Approved Sender ID dose not match !', 1010);
        }
    }

    // Specify your type of message
    private $type = 'text';

    // Specify your contacts
    private $contacts;

    // Specify your message
    private $msg;

    /**
     * APi Key from bulksmsbd.com
     *
     * @return string
     */
    private function apiKey()
    {
        return config('bulksmsbd.api_key');
    }

    /**
     * Sender ID from bulksmsbd.com
     *
     * @return string
     */
    private function senderID()
    {
        return config('bulksmsbd.sender_id');
    }

    /**
     * Mode of sending sms
     *
     * @return string
     */
    private function mode()
    {
        return config('bulksmsbd.mode');
    }

    /**
     * Client Init
     *
     * @return Client
     */
    private function client()
    {
        return new Client(['verify' => config('bulksmsbd.verify'), 'base_uri' => config('bulksmsbd.base_uri')]);
    }

    /**
     * Store Error in log file
     *
     * @return void
     */
    private function logSMS(): void
    {
        if ($this->mode() == 'log') {
            $this->logError([
                'contacts' => $this->contacts,
                'msg' => $this->msg,
            ]);
        }
    }

    /**
     * Set one to one sms sending format
     *
     * @param  string  $contacts='88017xxxxxxxx';
     * @param  string  $msg='test message';
     * @param  string  $type='text';
     */
    public function oneToOne(string $contacts, string $msg, string $type = 'text')
    {
        // Check if contacts is valid
        if (\preg_match("/^(?:\+88|88)?(01[3-9]\d{8})$/", $contacts)) {
            $contacts = $contacts;
        } else {
            throw  new \Exception('Number Not Valid', 1012);
        }

        // set message
        $this->msg = $msg;
        // set type
        $this->type = $type;
        // Set contacts
        $this->contacts = $contacts;
        // return object
        return $this;
    }

    /**
     * Set one to one sms sending format
     *
     * @param  array  $contacts=['88017xxxxxxxx',+'88018xxxxxxxx'];
     * @param  string  $msg='test message';
     * @param  string  $type='text';
     */
    public function oneToMany(array $contacts, string $msg, string $type = 'text')
    {
        // Check if contacts is array
        $numbers = [];
        // foreach contacts
        foreach ($contacts as $contact) {
            // Check if contacts is valid
            if (\preg_match("/^(?:\+88|88)?(01[3-9]\d{8})$/", $contact)) {
                // Push contacts to numbers array
                array_push($numbers, $contact);
            } else {
                throw  new \Exception('Number Not Valid', 1012);
            }
        }
        // Implode contacts to string
        $contacts = \implode(',', $numbers);

        // set message
        $this->msg = $msg;
        // set type
        $this->type = $type;
        // Set contacts
        $this->contacts = $contacts;
        // return object
        return $this;
    }

    /**
     * Set many to many sms sending format
     *
     * @param  array  $contacts=[[to=>'88017xxxxxxxx',message=>'message']];
     */
    public function manyToMany(array $contacts)
    {
        foreach ($contacts as $key => $value) {
            //  if message is not set or not string throw exception
            if ((!isset($value['message'])) || !is_string($value['message'])) {
                throw  new \Exception('Massage Not  Valid', 1014);
            }
            // if to is not set or not valid number throw exception
            if ((!isset($value['to'])) || !\preg_match("/^(?:\+88|88)?(01[3-9]\d{8})$/", $value['to'])) {
                throw  new \Exception('Number Not  Valid', 1012);
            }
        }
        // Set contacts many to many format
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Getting Balance
     *
     * @return string
     */
    public function getBalance()
    {
        $response = $this->client()->request('GET', 'getBalanceApi', [
            'query' => [
                'api_key' => $this->apiKey(),
            ],
        ]);

        return $this->validateResponse(\json_decode($response->getBody()));
    }

    /**
     * If sms sent true return else throws Exception
     *
     * @param $numbers
     * @param $message
     */
    public function send()
    {
        // check if mode is log
        if ($this->logSMS()) {
            return true;
        }
        // check if message is set
        if ($this->msg) {
            $data = [
                'api_key' => $this->apiKey(),
                'type' => $this->type,
                'number' => $this->contacts,
                'senderid' => $this->senderID(),
                'message' => $this->msg,
            ];
            $response = $this->client()->post('smsapi', [
                'form_params' => $data,
            ]);
        } else {
            $data = [
                'api_key' => $this->apiKey(),
                'senderid' => $this->senderID(),
                'messages' => json_encode($this->contacts),
            ];
            $response = $this->client()->post('smsapimany', [
                'form_params' => $data,
            ]);
        }
        // validate response
        return $this->validateResponse(\json_decode($response->getBody()));
    }

    /**
     *Error Code	Meaning
     *1002	Sender Id/Masking Not Found
     *1003	API Not Found
     *1004	SPAM Detected
     *1005	Internal Error
     *1006	Internal Error
     *1007	Balance Insufficient
     *1008	Message is empty
     *1009	Message Type Not Set (text/unicode)
     *1010	Invalid User & Password
     *1011	Invalid User Id
     *1012	Invalid Number
     *1013	API limit error
     *1014	No matching template
     */
    private function validateResponse($response)
    {
        switch ((string) $response->response_code) {
            case  202:
                return $response;
                break;

            case  1002:
                $this->logError('Validation Error', $response);
                throw new \Exception('Sender Id/Masking Not Found', 1002);
                break;

            case  1003:
                $this->logError('Validation Error', $response);
                throw new \Exception('API Not Found', 1003);
                break;

            case  1004:
                $this->logError('Validation Error', $response);
                throw new \Exception('SPAM Detected', 1004);
                break;

            case  1005:
                $this->logError('Validation Error', $response);
                throw new \Exception('Internal Error', 1005);
                break;

            case  1006:
                $this->logError('Validation Error', $response);
                throw new \Exception('Internal Error', 1006);
                break;

            case  1007:
                $this->logError('Validation Error', $response);
                throw new \Exception('Balance Insufficient', 1007);
                break;

            case  1008:
                $this->logError('Validation Error', $response);
                throw new \Exception('Message is empty', 1008);
                break;

            case  1009:
                $this->logError('Validation Error', $response);
                throw new \Exception('Message Type Not Set (text/unicode)', 1009);
                break;

            case  1010:
                $this->logError('Validation Error', $response);
                throw new \Exception('Invalid User & Password', 1010);
                break;

            case  1011:
                $this->logError('Validation Error', $response);
                throw new \Exception('Invalid User Id', 1011);
                break;

            case  1012:
                $this->logError('Validation Error', $response);
                throw new \Exception('Invalid Number', 1012);
                break;

            case  1013:
                $this->logError('Validation Error', $response);
                throw new \Exception('API limit error', 1013);
                break;

            case  1014:
                $this->logError('Validation Error', $response);
                throw new \Exception('No matching template', 1014);
                break;

            case  1015:
                $this->logError('Validation Error', $response);
                throw new \Exception('Sender Id has not found Any Valid Gateway by api key', 1015);
                break;

            case  1016:
                $this->logError('Validation Error', $response);
                throw new \Exception('Sender Type Name Active Price Info not found by this sender id', 1016);
                break;

            case  1017:
                $this->logError('Validation Error', $response);
                throw new \Exception('Sender Type Name Price Info not found by this sender id', 1017);
                break;

            case  1018:
                $this->logError('Validation Error', $response);
                throw new \Exception('The Owner of this (username) Account is disabled', 1018);
                break;

            case  1019:
                $this->logError('Validation Error', $response);
                throw new \Exception('The (sender type name) Price of this (username) Account is disabled', 1019);
                break;

            case  1020:
                $this->logError('Validation Error', $response);
                throw new \Exception('The parent of this account is not found.', 1020);
            case  1021:
                $this->logError('Validation Error', $response);
                throw new \Exception('The parent active (sender type name) price of this account is not found.', 1021);
                break;

            default:
                $this->logError('Validation Error', $response);
                throw  new \Exception('Unknown', -1);
                break;
        }
    }

    /**
     * Log error in laravel-bulk-sms-bd-log.log
     *
     * @param $response
     */
    private function logError($error, $response = [])
    {
        Log::build([
            'driver' => \config('bulksmsbd.log.driver', 'single'),
            'path' => \config('bulksmsbd.log.path', storage_path('logs/laravel-bulk-sms-bd-log.log')),
        ])->error($error, (array) $response);
    }
}
