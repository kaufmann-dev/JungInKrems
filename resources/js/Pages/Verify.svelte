<script>
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import Button from '../Shared/Button.svelte';
    import H1 from '../Shared/H1.svelte';
    import Subtitle from '../Shared/Subtitle.svelte';
</script>

<svelte:head>
    <title>Verifiziert</title>
    <meta name="description" content="Verifiziert">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<CenterDiv>
    <div class="tw-text-center">
      <H1 mb={false}>E-Mail bestätigt</H1>
      <Subtitle>Sie haben Ihre E-Mail Adresse erfolgreich bestätigt.</Subtitle>
      <Button link="/">Zurück zur Startseite</Button>
    </div>
  </CenterDiv>