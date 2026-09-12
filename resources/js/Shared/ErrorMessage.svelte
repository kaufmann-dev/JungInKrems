<script>
    /**
     * @typedef {Object} Props
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { children } = $props();
</script>

<span class="tw:text-red-500 tw:text-sm tw:mt-1 tw:mb-0">
    {@render children?.()}
</span>