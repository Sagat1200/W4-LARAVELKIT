<div class="flex flex-col justify-center items-center bg-base-300">
    <div class="text-center hero-content">
        <div class="max-w-md">
            <h1 class="text-4xl font-bold">{{ $title }}</h1>
            {{-- <h1 class="text-5xl font-bold">{{ auth::user()->name }}</h1> --}}
            <p class="py-6">
                {{ $message }}
            </p>
            <a href="{{ route($route) }}" class="btn btn-primary" wire:navigate>{{ $textButton }}</a>
        </div>
    </div>
</div>
{{-- @include('components.w4laravelkit.design.centerhero', [
      'title' => 'Title',
      'message' => 'Message',
      'route' => 'Route',
      'textButton' => 'Button',
  ])  --}}

{{--<x-w4laravelkit.design.centerhero 
    :title="'Title'" 
    :message="'Message'" 
    :route="'Route'" 
    :text-button="'Button'" 
/>--}}