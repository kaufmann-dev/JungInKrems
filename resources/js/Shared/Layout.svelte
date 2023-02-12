<script>
    import Navbar from './Navbar.svelte';
    import Footer from './Footer.svelte';
</script>

<svelte:head>
    <title>Home</title>
    <meta name="description" content="Home page">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<Navbar />
<div class="tw-flex-grow">
    <div class="container tw-h-full">
        <slot/>
    </div>
</div>
<Footer />
