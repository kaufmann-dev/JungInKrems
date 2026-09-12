<script>
  import { inertia } from '@inertiajs/svelte';
  import Button from './Button.svelte';

  let { root, data } = $props();
	let innerWidth = $state(0);
  
</script>

<svelte:window bind:innerWidth />

{#if innerWidth >= 1024}
  <div class="tw:shrink-0 tw:lg:w-64 tw:bg-gray-50 tw:border tw:rounded-lg tw:overflow-hidden">
    <div class="tw:border-b tw:relative">
        <a href={root.href} use:inertia class="tw:cursor-pointer tw:hover:text-black tw:block tw:px-4 tw:py-3 tw:text-base tw:font-medium tw:hover:drop-shadow-lg tw:text-gray-600 tw:transition-all duration-150">{root.name}</a>
    </div>
    <nav class="tw:flex-grow tw:overflow-y-auto tw:divide-y">
        {#each data as item}
            <a href={item.href} use:inertia class="tw:cursor-pointer tw:hover:text-black tw:block tw:px-4 tw:py-3 tw:text-base tw:font-normal tw:hover:drop-shadow-lg tw:text-gray-600 tw:transition-all duration-150">
                {item.name}
            </a>
        {/each}
    </nav>
  </div>
{:else}
  <div class="tw:-mr-2">
    {#each data as item}
      <div class="tw:mr-2 tw:mt-2 tw:inline-block">
        <Button size="small" link={item.href}><div class="tw:mx-2">{item.name}</div></Button>
      </div>
    {/each}
  </div>
{/if}