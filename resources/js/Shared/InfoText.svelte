<script>
    /**
     * @typedef {Object} Props
     * @property {string} [color]
     * @property {string} [mb]
     * @property {string} [mt]
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let {
        color = 'gray',
        mb = 'false',
        mt = 'false',
        children
    } = $props();
</script>

<div class="{color === 'green' ? 'tw:bg-green-400' : color === 'gray' ? 'tw:bg-gray-300' : color === 'blue' ? 'tw:bg-blue-400' : color === 'light' ? 'tw:bg-white' : color === 'red' ? 'tw:bg-red-400' : ''} {mb == 'true' ? 'tw:mb-1.5' : ''} {mt == 'true' ? 'tw:mt-1.5' : ''} {color === 'light' ? 'tw:rounded tw:border tw:border-gray-10 tw:text-gray-600' : 'tw:rounded-full'} tw:py-0.5 tw:px-3 tw:inline-block ">
    {@render children?.()}
</div>