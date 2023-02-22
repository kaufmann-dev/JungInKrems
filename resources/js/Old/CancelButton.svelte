<script>
    export let link;
    export let onClick = () => {};
    import { inertia } from '@inertiajs/svelte';
</script>

<div on:click={onClick} class="tw-cursor-pointer hover:tw-bg-gray-600 tw-duration-200 hover:tw--translate-y-1 hover:tw-scale-105 tw-bg-gray-500 tw-text-white hover:tw-shadow-xl focus:tw-outline-none tw-font-medium tw-rounded-3xl tw-text-sm tw-text-center tw-inline-block hover:tw-rounded-sm">
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


