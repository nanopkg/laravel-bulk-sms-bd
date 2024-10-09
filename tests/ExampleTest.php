<?php

// Test Set BulkSmsBd Config Mode log
test('set BulkSmsBd Config Mode log', function () {
    config(['bulksmsbd.mode' => 'log']);
    $this->assertEquals('log', config('bulksmsbd.mode'));
});

// Check BulkSmsBd Instance Test
test('check BulkSmsBd instance', function () {
    $this->assertInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class, \Nanopkg\BulkSmsBd\Facades\BulkSmsBd::getFacadeRoot());
});

// Check BulkSmsBd OneToOne Test
test('check BulkSmsBd OneToOne', function () {
    $this->assertInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class, \Nanopkg\BulkSmsBd\Facades\BulkSmsBd::OneToOne('8801700000000', 'message'));
});

// Check BulkSmsBd OneToMany Test
test('check BulkSmsBd OneToMany', function () {
    $this->assertInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class, \Nanopkg\BulkSmsBd\Facades\BulkSmsBd::OneToMany(['8801700000000', '8801800000000'], 'message'));
});

// Check BulkSmsBd ManyToMany Test
test('check BulkSmsBd ManyToMany', function () {
    $this->assertInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class, \Nanopkg\BulkSmsBd\Facades\BulkSmsBd::ManyToMany([
        ['to' => '8801700000000', 'message' => 'message'],
    ]));
});

// Check BulkSmsBd Send Test
test('check BulkSmsBd Send', function () {
    $this->assertTrue(\Nanopkg\BulkSmsBd\Facades\BulkSmsBd::send());
});

// Check BulkSmsBd OneToOne Job Test
test('check BulkSmsBd OneToOne Job', function () {
    $this->assertInstanceOf(\Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToOne::class, new \Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToOne('8801700000000', 'message'));
});

// Check BulkSmsBd OneToMany Job Test
test('check BulkSmsBd OneToMany Job', function () {
    $this->assertInstanceOf(\Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToMany::class, new \Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToMany(['8801700000000', '8801800000000'], 'message'));
});

// Check BulkSmsBd Channel Test
test('check BulkSmsBd Channel', function () {
    $this->assertInstanceOf(\Nanopkg\BulkSmsBd\Broadcasting\BulkSmsBdChannel::class, new \Nanopkg\BulkSmsBd\Broadcasting\BulkSmsBdChannel());
});
