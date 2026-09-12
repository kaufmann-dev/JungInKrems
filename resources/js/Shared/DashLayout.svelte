<script>
    import Navbar from './Navbar.svelte';
    import Footer from './Footer.svelte';
    import Sidebar from './Sidebar.svelte';
    /**
     * @typedef {Object} Props
     * @property {import('svelte').Snippet} [children]
     */

    /** @type {Props} */
    let { children } = $props();

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
    <title>Dashboard</title>
    <meta name="description" content="Dashboard">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<Navbar />
<div class="tw:flex-grow">
    <div class="container tw:h-full">
        <div class="tw:lg:flex tw:lg:flex-row tw:h-full">
            <Sidebar root={root} data={data} />
            <div class="tw:lg:ml-3 tw:overflow-hidden tw:w-full px-0 tw:mt-3 tw:lg:mt-0">
                {@render children?.()}
            </div>
        </div>
    </div>
</div>
<Footer />
