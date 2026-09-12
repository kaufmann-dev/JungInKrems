<script>
    import Navbar from './Navbar.svelte';
    import Footer from './Footer.svelte';
    /**
     * @typedef {Object} Props
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { children } = $props();
</script>

<svelte:head>
    <title>Jung in Krems</title>
    <meta name="description" content="Jung in Krems">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<Navbar />
<div class="tw:flex-grow">
    <div class="container tw:h-full">
        {@render children?.()}
    </div>
</div>
<Footer />
