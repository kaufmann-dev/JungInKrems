<script>
  import { page, inertia } from '@inertiajs/svelte';
  export let root;
  export let data;
</script>

<div class="tw-shrink-0 lg:tw-w-64 tw-bg-gray-50 tw-border tw-rounded-lg tw-overflow-hidden">
  <div class="tw-bg-gray-200 tw-p-4 tw-text-center tw-relative">
      <span use:inertia="{{ href: root.href, method: 'get' }}" class="tw-cursor-pointer tw-text-lg tw-font-medium tw-text-gray-700">{root.name}</span>
  </div>
  <nav class="tw-flex-grow tw-overflow-y-auto tw-divide-y">
      {#each data as item}
          <span use:inertia="{{ href: item.href, method: 'get' }}" class="tw-cursor-pointer hover:tw-bg-gray-100 tw-block tw-px-4 tw-py-3 tw-text-base tw-font-medium tw-text-gray-700 tw-transition-all duration-150">
              {item.name}
          </span>
      {/each}
  </nav>
</div>