<?php

namespace Nanopkg\LaravelBulkSmsBd;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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
    private  function senderID()
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
    private  function client()
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
        if (self::MODE() == 'log') {
            $this->logError([
                'contacts' => $this->contacts,
                'msg' => $this->msg,
            ]);
        }
    }

    /**
     * Set one to one sms sending format
     * @param $contacts=['88017xxxxxxxx',+'88018xxxxxxxx'];
     * @param string $msg='test message';
     * @param string $type='text';
     *
     */
    public function OneToOne($contacts, $msg, $type = 'text'): void
    {
        // set message
        $this->msg = $msg;
        // set type
        $this->type = $type;

        // Check if contacts is array
        if (is_array($contacts)) {
            $numbers = [];
            foreach ($contacts as $key => $value) {
                if ($key == 0) {
                    if (strlen($value) == 11) {
                        array_push($numbers, $value);
                    } elseif (strlen($value) == 14) {
                        array_push($numbers, substr($value, 3, 14));
                    } else {
                        throw  new \Exception('Number Not Valid', 1012);
                    }
                    continue;
                }
                if (strlen($value) == 11) {
                    array_push($numbers, '+88' . $value);
                } elseif (strlen($value) == 14) {
                    array_push($numbers, '+88' . substr($value, 3, 14));
                }
            }
            $contacts = implode('', $numbers);
        } else {
            if (strlen($contacts) == 11) {
                $contacts = $contacts;
            } elseif (strlen($contacts) == 14) {
                $contacts = substr($contacts, 3, 14);
            } else {
                throw  new \Exception('Number Not Valid', 1012);
            }
        }
        // Set contacts
        $this->contacts = $contacts;
    }


    /**
     * Set many to many sms sending format
     *
     * @param array $contacts=[[to=>'88017xxxxxxxx',message=>'message']];
     *
     */
    public function ManyToMany(array $contacts): void
    {
        if (is_array($contacts)) {
            foreach ($contacts as $key => $value) {
                if ((!isset($value['message'])) || (!isset($value['to']))) {
                    throw  new \Exception('Format Not  Valid', 1014);
                }
            }
        } else {
            throw  new \Exception('Format Not  Valid', 1014);
        }
        // Set contacts many to many format
        $this->contacts = $contacts;
    }


    /**
     * Getting Balance
     *
     * @return string
     */
    public function getBalance()
    {
        $response = $this->client()->request('GET', 'getBalanceApi', [
            'api_key' => $this->apiKey(),
        ]);

        return $response->getBody();
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

    /**
     * If sms sent true return else throws Exception
     *
     * @param $numbers
     * @param $message
     * @return bool
     *
     * @throws \Exception
     */
    public function send()
    {
        if ($this->logSMS()) {
            return true;
        }

        if ($this->msg) {
            $data = [
                'api_key' => self::apiKey(),
                'type' => $this->type,
                'contacts' => $this->contacts,
                'senderid' => self::senderID(),
                'msg' => $this->msg,
            ];
            $response = self::CLIENT()->post('smsapi', [
                'form_params' => $data,
            ]);
        } else {
            $data = [
                'api_key' => self::apiKey(),
                'senderid' => self::senderID(),
                'messages' => json_encode($this->contacts),
                // 'messages' => json_encode($this->contacts),
            ];
            $response = self::CLIENT()->post('smsapimany', [
                'form_params' => $data,
            ]);
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
        switch ((string) $response->getBody()) {
            case  1002:
                $this->logError($response);
                throw new \Exception('Sender Id/Masking Not Found', 1002);
                break;
            case  1003:
                $this->logError($response);
                throw new \Exception('API Not Found', 1003);
                break;
            case  1004:
                $this->logError($response);
                throw new \Exception('SPAM Detected', 1004);
                break;
            case  1005:
                $this->logError($response);
                throw new \Exception('Internal Error', 1005);
                break;
            case  1006:
                $this->logError($response);
                throw new \Exception('Internal Error', 1006);
                break;
            case  1007:
                $this->logError($response);
                throw new \Exception('Balance Insufficient', 1007);
                break;
            case  1008:
                $this->logError($response);
                throw new \Exception('Message is empty', 1008);
                break;
            case  1009:
                $this->logError($response);
                throw new \Exception('Message Type Not Set (text/unicode)', 1009);
                break;
            case  1010:
                $this->logError($response);
                throw new \Exception('Invalid User & Password', 1010);
                break;
            case  1011:
                $this->logError($response);
                throw new \Exception('Invalid User Id', 1011);
                break;
            case  1012:
                $this->logError($response);
                throw new \Exception('Invalid Number', 1012);
                break;
            case  1013:
                $this->logError($response);
                throw new \Exception('API limit error', 1013);
                break;

            case  1014:
                $this->logError($response);
                throw new \Exception('No matching template)', 1014);
                break;
            default:
                $this->logError($response);

                return true;
                break;
        }
        $this->logError($response);
        throw  new \Exception('Unknown', -1);
    }

    /**
     * Log error in laravel-bulk-sms-bd-log.log
     *
     * @param $response
     */
    private  function logError(array $error)
    {
        Log::build([
            'driver' => \config('bulksmsbd.log.driver', 'single'),
            'path' => \config('bulksmsbd.log.path', storage_path('logs/laravel-bulk-sms-bd-log.log')),
        ])->error($error ?? []);
    }
}
