<?php

// Test Set BulkSmsBd Config Mode log
test('set BulkSmsBd Config Mode log', function () {
    expect(config('bulksmsbd.mode'))->toEqual('log');
});

// Check BulkSmsBd Instance Test
test('check BulkSmsBd instance', function () {
    expect(\Nanopkg\BulkSmsBd\Facades\BulkSmsBd::getFacadeRoot())->toBeInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class);
});

// Check BulkSmsBd OneToOne Test
test('check BulkSmsBd OneToOne', function () {
    expect(\Nanopkg\BulkSmsBd\Facades\BulkSmsBd::OneToOne('8801700000000', 'message'))
        ->toBeInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class);
});

// Check BulkSmsBd OneToMany Test
test('check BulkSmsBd OneToMany', function () {
    expect(\Nanopkg\BulkSmsBd\Facades\BulkSmsBd::OneToMany(['8801700000000', '8801800000000'], 'message'))
        ->toBeInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class);
});

// Check BulkSmsBd ManyToMany Test
test('check BulkSmsBd ManyToMany', function () {
    expect(\Nanopkg\BulkSmsBd\Facades\BulkSmsBd::ManyToMany([
        ['to' => '8801700000000', 'message' => 'message'],
    ]))->toBeInstanceOf(\Nanopkg\BulkSmsBd\BulkSmsBd::class);
});

// Check BulkSmsBd Send Test
test('check BulkSmsBd Send', function () {
    expect(\Nanopkg\BulkSmsBd\Facades\BulkSmsBd::send())
        ->toBeTrue();
});

// Check BulkSmsBd OneToOne Job Test
test('check BulkSmsBd OneToOne Job', function () {
    expect(new \Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToOne('8801700000000', 'message'))
        ->toBeInstanceOf(\Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToOne::class);
});

// Check BulkSmsBd OneToMany Job Test
test('check BulkSmsBd OneToMany Job', function () {
    expect(new \Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToMany(['8801700000000', '8801800000000'], 'message'))
        ->toBeInstanceOf(\Nanopkg\BulkSmsBd\Jobs\BulkSmsBdOneToMany::class);
});

// Check BulkSmsBd Channel Test
test('check BulkSmsBd Channel', function () {
    expect(new \Nanopkg\BulkSmsBd\Broadcasting\BulkSmsBdChannel)
        ->toBeInstanceOf(\Nanopkg\BulkSmsBd\Broadcasting\BulkSmsBdChannel::class);
});
