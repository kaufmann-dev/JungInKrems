<script>
    import Layout from '../Shared/Layout.svelte'
    import Button from '../Shared/Button.svelte'
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import H2 from '../Shared/H2.svelte';
    import H3 from '../Shared/H3.svelte';
    import D1 from '../Shared/D1.svelte';
</script>

<Layout>
    <CenterDiv>
    <div class="tw-text-center tw-my-10">
        <D1 mb={false}>Jung in Krems</D1>
        <H2><span class="tw-text-yellow-400">Willkommen!</span></H2>
        <div class="tw-grid tw-gap-6 md:tw-gap-20 md:tw-grid-cols-2 tw-mb-10">
            <div>
                <H3>Was ist Jung in Krems?</H3>
                <span>Jung in Krems ist eine Plattform für junge Menschen in Krems an der Donau. Hier findest du alle wichtigen Informationen rund um aktuelle Events und Schulen und Universitäten in der Stadt.</span>
            </div>
            <div>
                <H3>Warum gibt es Jung in Krems?</H3>
                <span>Die Stadt Krems an der Donau hat viele junge Menschen, die sich hier wohlfühlen und die Stadt mitgestalten. Jung in Krems ist eine Plattform, die junge Menschen in Krems an der Donau zusammenbringt und ihnen hilft, sich in der Stadt zurechtzufinden.</span>
            </div>
        </div>
        <Button link="/events">Events entdecken</Button>
    </div>
</CenterDiv>
</Layout>