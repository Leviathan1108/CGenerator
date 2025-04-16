@extends('layouts.nc') {{-- Asumsikan kamu pakai layout nc.blade.php untuk UI stepper --}}

@section('title', 'Create New Certificate - Step 1')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-2">Create New Certificate</h1>
    <p class="text-gray-600 mb-6">Follow the steps below to create and publish your certificate</p>

    {{-- Stepper Navigation --}}
    <div class="mb-8">
        <div class="flex justify-between items-center text-center">
            @foreach (['Select Background', 'Upload/Select', 'Preview', 'Input Data', 'Upload Logo', 'Generate', 'Review', 'Request Approval', 'Publish'] as $index => $step)
                <div class="flex-1">
                    <div class="text-sm font-semibold {{ $index === 0 ? 'text-blue-600' : 'text-gray-400' }}">
                        {{ $index + 1 }}<br>
                        {{ $step }}
                    </div>
                    @if ($index < 8)
                        <div class="w-full h-1 bg-{{ $index === 0 ? 'blue' : 'gray' }}-300 mx-auto mt-1"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- Template Selection --}}
    <div class="mb-4">
        <h2 class="text-xl font-semibold mb-4">Select Certificate Template</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid
