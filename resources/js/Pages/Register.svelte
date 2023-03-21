<script>
    import { Link, router } from '@inertiajs/svelte';
    import Layout from '../Shared/Layout.svelte';
    import Button from '../Shared/Button.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import FloatingForm from '../Shared/FloatingForm.svelte';
    import H1 from '../Shared/H1.svelte';

    let registered = false;

    $: data = [{
      name: 'Name',
      bind: 'name',
      type: 'text',
      value: '',
      errorname: 'name',
      error: '',
    },{
      name: 'E-Mail',
      bind: 'email',
      type: 'email',
      value: '',
      errorname: 'email',
      error: '',
    },{
      name: 'Passwort',
      bind: 'password',
      type: 'password',
      value: '',
      errorname: 'password',
      error: '',
    },{
      name: 'Passwort wiederholen',
      bind: 'password_confirmation',
      type: 'password',
      value: '',
      errorname: 'password_confirmation',
      error: '',
    },{
      name: 'Datenschutzerklärung akzeptieren',
      bind: 'terms',
      type: 'checkbox',
      value: false,
      errorname: 'terms',
      error: '',
    }];

    let submit = () => {
      let submitdata = data.map(element => {
        if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
            return {
                [element["bind"]]: element["value"]
            }
          }
        }).reduce((a, b) => Object.assign(a, b), {});
      
      axios.post('/register', submitdata)
      .then(response => {
          if (response.status === 200) {
            registered = true;
          }
      })
      .catch(error => {
        console.log(error);
          if (error?.response?.status === 422) {
            for (const [key, value] of Object.entries(data)) {
              if(error.response.data.errors[value["errorname"]]) {
                data[key]["error"] = error.response.data.errors[value["errorname"]][0];
              } else {
                data[key]["error"] = "";
              }
            }
          }
      });
      
      /*router.visit('/register', {
        method: 'post',
        data: submitdata,
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          registered = true;
        },
        onError: errors => {
          console.log(errors);
          for(const [key, value] of Object.entries(data)) {
            if(errors[value["errorname"]]) {
              data[key]["error"] = errors[value["errorname"]];
            } else {
              data[key]["error"] = "";
            }
          }
        }
      });*/
    }
</script>

<Layout>
    <CenterDiv>
        <div class="tw-text-center">
          {#if registered == true}
            <H1 mb={false}>Sie wurden registriert.</H1>
            <Button link="/login">Anmelden</Button>
          {:else}
            <FloatingForm name="Registrieren" {data} onSubmit={submit}></FloatingForm>
            <div class="tw-text-center tw-mt-2">
              <a class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="https://www.krems.at/datenschutzerklaerung">Datenschutzerklärung</a><br>
              <Link class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="/login">Anmelden</Link>
            </div>
        {/if}
      </div>
    </CenterDiv>
</Layout>