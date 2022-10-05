<script>
    import Navbar from './Navbar.svelte';
    import Footer from './Footer.svelte';
    import Sidebar from './Sidebar.svelte';
    import { page } from '@inertiajs/svelte';

    let root = {
        name: 'Mein Account',
        href: '/account',
    }

    $: data = [
        {
            name: 'Meine Events',
            href: '/account/events',
        },
        {
            name: 'Meine Bildungsanstalten',
            href: '/account/facilities',
        },
        {
            name: 'Meine Anträge',
            href: '/account/requests',
        },{
            name: 'E-Mail Bestätigung',
            href: '/account/verify',
        }
    ];
</script>

<svelte:head>
    <title>Account</title>
    <meta name="description" content="Account">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<Navbar />
<div class="tw-flex-grow">
    <div class="container tw-h-full">
        <div class="tw-flex tw-flex-col lg:tw-flex-row tw-h-full">
            <Sidebar root={root} data={data} />
            <div class="lg:tw-ml-3 tw-overflow-hidden tw-w-full px-0 tw-mt-3 lg:tw-mt-0">
                <slot/>
            </div>
        </div>
    </div>
</div>
<Footer />
