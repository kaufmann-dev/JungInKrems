<script>
    import Navbar from './Navbar.svelte';
    import Footer from './Footer.svelte';
    import Sidebar from './Sidebar.svelte';

    let root = {
        name: 'Dashboard',
        href: '/dashboard',
    }

    let data = [
        {
            name: 'Konten',
            href: '/dashboard/accounts',
        },
        {
            name: 'Events',
            href: '/dashboard/events',
        },
        {
            name: 'Bildungseinrichtungen',
            href: '/dashboard/facilities',
        },
        {
            name: 'Anträge',
            href: '/dashboard/requests',
        }
    ];
</script>

<svelte:head>
    <title>Home</title>
    <meta name="description" content="Home page">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<Navbar />
<div class="tw-flex-grow"> <!-- tw-flex tw-justify-center -->
    <div class="container tw-h-full"> <!-- tw-max-w-screen-xl tw-px-3 -->
        <div class="lg:tw-flex lg:tw-flex-row tw-h-full">
            <Sidebar root={root} data={data} />
            <div class="lg:tw-ml-3 tw-overflow-hidden tw-w-full px-0 tw-mt-3 lg:tw-mt-0">
                <slot/>
            </div>
        </div>
    </div>
</div>
<Footer />
