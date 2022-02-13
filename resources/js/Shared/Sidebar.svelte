<script>
  import { page, inertia } from '@inertiajs/svelte';
  export let root;
  export let data;
</script>

<div class="tw-shrink-0 lg:tw-w-64 tw-bg-gray-50 tw-border tw-rounded-lg tw-overflow-hidden">
  <div class="tw-border-b tw-relative">
      <span use:inertia="{{ href: root.href, method: 'get' }}" class="tw-cursor-pointer hover:tw-text-black tw-block tw-px-4 tw-py-3 tw-text-base tw-font-medium hover:tw-drop-shadow-lg tw-text-gray-600 tw-transition-all duration-150">{root.name}</span>
  </div>
  <nav class="tw-flex-grow tw-overflow-y-auto tw-divide-y">
      {#each data as item}
          <span use:inertia="{{ href: item.href, method: 'get' }}" class="tw-cursor-pointer hover:tw-text-black tw-block tw-px-4 tw-py-3 tw-text-base tw-font-normal hover:tw-drop-shadow-lg tw-text-gray-600 tw-transition-all duration-150">
              {item.name}
          </span>
      {/each}
  </nav>
</div>