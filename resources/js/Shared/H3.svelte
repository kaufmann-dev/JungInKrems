<script>
    /**
     * @typedef {Object} Props
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { children } = $props();
</script>

<span class='tw:block tw:text-2xl tw:mb-1 tw:font-medium'>
    {@render children?.()}
</span>