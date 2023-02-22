<script>
    export let text;
    export let type = 'primary';
    export let onClick = () => {};    
</script>

<style>
    button {
        min-width: 120px;
    }
</style>

<button on:click={onClick} type="{type == 'primary' ? 'submit' : 'button'}" class="{type == 'primary' ? 'tw-bg-yellow-400 hover:tw-bg-yellow-500 tw-text-black' : type == 'danger' ? 'tw-bg-red-500 hover:tw-bg-red-600 tw-text-white' : type == 'light' ? 'tw-bg-gray-500 hover:tw-bg-gray-600 tw-text-white' : ''} tw-inline-block  tw-duration-200 hover:tw--translate-y-1 hover:tw-scale-105 focus:tw-outline-none tw-font-medium tw-text-sm tw-text-center hover:tw-shadow-xl tw-rounded-3xl tw-py-2 tw-px-4 hover:tw-rounded-sm">
{#if text}
    {text}
{:else}
    <slot />
{/if}
</button>