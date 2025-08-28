<x-layouts.app>
  <div style="text-align:center; margin-top:50px;">
      <h1>Counter: {{ $count }}</h1>
      <button wire:click="decrement">-</button>
      <button wire:click="increment">+</button>
  </div>
</x-layouts.app>
