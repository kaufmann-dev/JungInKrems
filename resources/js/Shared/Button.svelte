<script>
    export let link;
    export let onClick = () => {};
    import { inertia } from '@inertiajs/svelte';
</script>

<div on:click={onClick} class="tw-cursor-pointer tw-text-white tw-bg-yellow-400 hover:tw-bg-yellow-500 focus:tw-outline-none  tw-font-medium tw-rounded-full tw-text-sm tw-text-center tw-inline-block">
    {#if link}
        <div class="tw-px-5 tw-py-2.5" use:inertia="{{ href: link, method: 'get' }}">
            <slot></slot>
        </div>
    {:else}
        <div class="tw-px-5 tw-py-2.5">
            <slot></slot>
        </div>
    {/if}
</div>


