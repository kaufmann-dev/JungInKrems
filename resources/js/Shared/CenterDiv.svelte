<script>
    /**
     * @typedef {Object} Props
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { children } = $props();
</script>

<div class="tw:grid tw:h-full tw:place-items-center">
    {@render children?.()}
</div>