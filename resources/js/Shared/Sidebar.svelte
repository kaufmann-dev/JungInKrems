<script>
  import { page, inertia } from '@inertiajs/svelte';
  import Button from './Button.svelte';

  export let root;
  export let data;
	$: innerWidth = 0;
</script>

<svelte:window bind:innerWidth />

{#if innerWidth >= 1024}
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
{:else}
  <div class="tw--mr-2">
    {#each data as item}
      <div class="tw-mr-2 tw-mt-2 tw-inline-block">
        <Button size="small" link={item.href}><div class="tw-mx-2">{item.name}</div></Button>
      </div>
    {/each}
  </div>
{/if}