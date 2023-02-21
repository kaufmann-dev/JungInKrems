<script>
    import Button from './Button.svelte';
    import { useForm } from '@inertiajs/svelte'
    import { inertia, page } from '@inertiajs/svelte';
    import axios from 'axios';

    /* function logout() {
        axios.post('logout');
    } */
</script>

<style>
    #navbarImage {
        height: 30px;
    }
</style>

<div class="tw-p-3">
    <nav class="navbar navbar-expand-lg navbar-light tw-bg-gray-50 tw-rounded-lg tw-border">
        <div class="container">
            <span class="tw-cursor-pointer navbar-brand" use:inertia="{{ href: "/", method: 'get' }}">
                <img id="navbarImage" src="/images/logo.png" alt="The Second Directory logo" height="30px" class="d-inline-block align-text-top">
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-grow-1 d-flex justify-content-center tw-gap-2">
                    <li class="nav-item">
                        <span use:inertia="{{ href: "/events", method: 'get' }}" class="tw-cursor-pointer nav-link"><i class="bi bi-calendar2-event-fill"></i> Events</span>
                    </li>
                    <li class="nav-item">
                        <span use:inertia="{{ href: "/facilities", method: 'get' }}" class="tw-cursor-pointer nav-link"><i class="bi bi-building-fill"></i> Bildung</span>
                    </li>
                        <li class="nav-item">
                            <span use:inertia="{{ href: "/bookmarks", method: 'get' }}" class="tw-cursor-pointer nav-link"><i class="bi bi-bookmark-fill"></i> Lesezeichen</span>
                        </li>
                </ul>
                {#if !$page?.props?.auth?.user}
                    <Button link={"/login"}><i class="bi bi-person-fill"></i> Anmelden</Button>
                {:else}
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      {$page.props.auth.user.NAME}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><span class="tw-cursor-pointer dropdown-item" use:inertia="{{ href: "/account", method: 'get' }}"><i class="bi bi-person-fill"></i> Account</span></li>
                      <li><span class="tw-cursor-pointer dropdown-item" use:inertia="{{ href: "/newevent", method: 'get' }}"><i class="bi bi-file-earmark-plus-fill"></i> Event anmelden</span></li>
                      {#if $page.props.auth.user.ACCOUNT_TYPE == 'Systemverwalter'}
                        <li><span class="tw-cursor-pointer dropdown-item" use:inertia="{{ href: "/dashboard", method: 'get' }}"><i class="bi bi-table"></i> Dashboard</span></li>
                      {/if}
                      <li><hr class="dropdown-divider"></li>
                      <!-- logout -->
                        <li><span class="tw-cursor-pointer dropdown-item" use:inertia="{{ href: "/logout", method: 'get' }}"><i class="bi bi-box-arrow-right"></i> Abmelden</span></li>
                    </ul>
                  </div>
                {/if}
            </div>
        </div>
    </nav>
</div>