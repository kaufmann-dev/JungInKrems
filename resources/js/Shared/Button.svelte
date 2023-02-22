<script>
    export let link;
    export let size = 'big';
    export let type = 'primary';
    export let title  = '';
    export let onClick = () => {};
    import { inertia } from '@inertiajs/svelte';
</script>

<div title={title} on:click={onClick} class="{type == 'primary' ? 'tw-text-black tw-bg-yellow-400 hover:tw-bg-yellow-500' : type == 'danger' ? 'tw-bg-red-500 hover:tw-bg-red-600 tw-text-white' : type == 'light' ? 'tw-bg-gray-500 hover:tw-bg-gray-600 tw-text-white' : type == 'success' ? 'tw-bg-green-400 hover:tw-bg-green-500 tw-text-white' : type == 'warning' ? 'tw-bg-orange-400 hover:tw-bg-orange-500 tw-text-white' : ''} { size === 'small' ? 'tw-rounded-md' : 'tw-rounded-3xl' } tw-cursor-pointer focus:tw-outline-none  tw-font-medium tw-text-center tw-inline-block hover:tw-shadow-xl hover:tw-rounded-sm tw-duration-200">
    {#if link}
        <div class="{ size === 'small' ? 'tw-py-0.5 tw-px-0.5 tw-font-normal' : 'tw-px-5 tw-py-2.5 tw-text-sm' }" use:inertia="{{ href: link, method: 'get' }}">
            <slot></slot>
        </div>
    {:else}
        <div class="{ size === 'small' ? 'tw-py-1 tw-px-2 tw-font-normal' : 'tw-px-5 tw-py-2.5 tw-text-sm' }">
            <slot></slot>
        </div>
    {/if}
</div>


