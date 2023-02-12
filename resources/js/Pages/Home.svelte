<script>
    import Layout from '../Shared/Layout.svelte'
    import Button from '../Shared/Button.svelte'
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import { page } from '@inertiajs/svelte'
</script>

<Layout>
    <CenterDiv>
    <div class="tw-text-center tw-my-10">
        <h1 class="tw-text-5xl tw-mb-6">Jung in Krems</h1>
        <h2 class="tw-text-yellow-400 tw-mb-10 tw-text-3xl">Willkommen!</h2>
        <div class="tw-grid tw-gap-6 md:tw-gap-20 md:tw-grid-cols-2 tw-mb-10">
            <div>
                <h3>Was ist Jung in Krems?</h3>
                <span>Jung in Krems ist eine Plattform für junge Menschen in Krems an der Donau. Hier findest du alle wichtigen Informationen rund um aktuelle Events und Schulen und Universitäten in der Stadt.</span>
            </div>
            <div>
                <h3>Warum gibt es Jung in Krems?</h3>
                <span>Die Stadt Krems an der Donau hat viele junge Menschen, die sich hier wohlfühlen und die Stadt mitgestalten. Jung in Krems ist eine Plattform, die junge Menschen in Krems an der Donau zusammenbringt und ihnen hilft, sich in der Stadt zurechtzufinden.</span>
            </div>
        </div>
        <Button link="/events">Entdecke Events</Button>
    </div>
</CenterDiv>
</Layout>