<script>
    export let link;
    export let size = 'big';
    export let onClick = () => {};
    import { inertia } from '@inertiajs/svelte';
</script>

<div on:click={onClick} class="tw-cursor-pointer tw-text-white tw-bg-yellow-400 hover:tw-bg-yellow-500 focus:tw-outline-none  tw-font-medium tw-rounded-full tw-text-center tw-inline-block">
    {#if link}
        <div class="{ size === 'small' ? 'tw-py-0.5 tw-px-4 tw-font-normal' : 'tw-px-5 tw-py-2.5 tw-text-sm' }" use:inertia="{{ href: link, method: 'get' }}">
            <slot></slot>
        </div>
    {:else}
        <div class="{ size === 'small' ? 'tw-py-0.5 tw-px-4 tw-font-normal' : 'tw-px-5 tw-py-2.5 tw-text-sm' }">
            <slot></slot>
        </div>
    {/if}
</div>


