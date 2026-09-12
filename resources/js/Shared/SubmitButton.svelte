<script>
    /**
     * @typedef {Object} Props
     * @property {any} text
     * @property {string} [type]
     * @property {any} [onClick]
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let {
        text,
        type = 'primary',
        onClick = () => {},
        children
    } = $props();
</script>

<style>
    button {
        min-width: 120px;
    }
</style>

<button onclick={onClick} type="{type == 'primary' ? 'submit' : 'button'}" class="{type == 'primary' ? 'tw:bg-yellow-400 tw:hover:bg-yellow-500 tw:text-black' : type == 'danger' ? 'tw:bg-red-500 tw:hover:bg-red-600 tw:text-white' : type == 'light' ? 'tw:bg-gray-500 tw:hover:bg-gray-600 tw:text-white' : ''} tw:inline-block  tw:duration-200 tw:hover:-translate-y-1 tw:hover:scale-105 tw:focus:outline-none tw:font-medium tw:text-sm tw:text-center tw:hover:shadow-xl tw:rounded-3xl tw:py-2 tw:px-4 tw:hover:rounded-sm">
{#if text}
    {text}
{:else}
    {@render children?.()}
{/if}
</button>