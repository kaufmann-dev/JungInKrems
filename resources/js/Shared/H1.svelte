<script>
    /**
     * @typedef {Object} Props
     * @property {boolean} [mb]
     * @property {boolean} [mt]
     * @property {boolean} [center]
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let {
        mb = true,
        mt = true,
        center = false,
        children
    } = $props();
</script>

<span class="{mb == true ? 'tw:mb-7' : 'tw:mb-4'} {mt == true ? 'tw:mt-3' : ''} {center == true ? 'tw:text-center' : ''} tw:text-black tw:block tw:text-4xl tw:md:text-4xl tw:lg:text-5xl tw:font-medium tw:drop-shadow-sm">
    {@render children?.()}
</span>