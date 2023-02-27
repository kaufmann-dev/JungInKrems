<script>
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import Button from '../Shared/Button.svelte';
    import H1 from '../Shared/H1.svelte';
    export let status;

    $: title = {
    503: '503: Service nicht verfügbar',
    500: '500: Server Fehler',
    404: '404: Seite nicht gefunden',
    403: '403: Zugriff verweigert',
    401: '401: Nicht autorisiert',
  }[status]

  $: description = {
    503: 'Wir arbeiten gerade an der Wiederherstellung des Dienstes.',
    500: 'Es ist ein Fehler aufgetreten.',
    404: 'Die angeforderte Seite konnte nicht gefunden werden.',
    403: 'Sie haben nicht die erforderlichen Rechte um diese Seite aufzurufen.',
    401: 'Sie müssen angemeldet sein um diese Seite aufzurufen.',
  }[status]
</script>

<CenterDiv>
  <div class="tw-text-center">
    <H1>{title}</H1>
    <span class="tw-mb-4">{description}</span>
    <Button link="/">Zurück zur Startseite</Button>
  </div>
</CenterDiv>