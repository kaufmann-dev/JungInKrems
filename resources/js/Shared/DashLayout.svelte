<script>
    import Navbar from './Navbar.svelte';
    import Footer from './Footer.svelte';
    import Sidebar from './Sidebar.svelte';
</script>

<svelte:head>
    <title>Home</title>
    <meta name="description" content="Home page">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<Navbar />
<div class="tw-flex-grow">
    <div class="mx-2 tw-h-full">
        <div class="tw-flex tw-flex-row tw-gap-4 tw-h-full">
            <Sidebar />
            <div class="tw-overflow-hidden tw-w-full">
                <slot/>
            </div>
        </div>
    </div>
</div>
<Footer />
