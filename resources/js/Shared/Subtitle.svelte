<script>
    /**
     * @typedef {Object} Props
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { children } = $props();
</script>

<span class="tw:text-gray-500 tw:border-b tw:pb-2 tw:mb-4 tw:block">
    {@render children?.()}
</span>