<script>
    import { page } from "@inertiajs/svelte";
    import { inertia } from '@inertiajs/svelte';
</script>

<footer class="pt-3">
    <ul class="tw-mx-3 nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="https://www.krems.at/impressum-1" class="nav-link px-2 text-muted">Impressum</a></li>
        <li class="nav-item"><a href="https://www.krems.at/datenschutzerklaerung" class="nav-link px-2 text-muted">Datenschutz</a></li>
        <li class="nav-item"><a href="https://www.krems.at/" class="nav-link px-2 text-muted">Stadt Krems</a></li>
        <li class="nav-item"><span use:inertia="{{ href: "/about", method: 'get' }}" class="tw-cursor-pointer nav-link px-2 text-muted">Über Uns</span></li>
        <li class="nav-item"><a href="/handbuch-jung-in-krems.pdf" class="nav-link px-2 text-muted">Handbuch</a></li>
        {#if $page.props.auth.user?.ACCOUNT_TYPE == 'Systemverwalter'}
            <li class="nav-item"><a href="/dashboard-handbuch-jung-in-krems.pdf" class="nav-link px-2 text-muted">Dashboard-Handbuch</a></li>
        {/if}
    </ul>
    <span class="text-center text-muted tw-mb-4 tw-block"><i class="bi bi-c-circle"></i> 2023 Stadt Krems</span>
</footer>