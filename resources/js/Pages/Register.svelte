<script>
    import { Link } from '@inertiajs/svelte';
    import Layout from '../Shared/Layout.svelte';
    import Button from '../Shared/Button.svelte';
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import FloatingForm from '../Shared/FloatingForm.svelte';
    import axios from 'axios';

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
    }
</script>

<Layout>
    <CenterDiv>
        <div class="tw-text-center">
          {#if registered == true}
            <h1 class="tw-mb-6">Sie wurden registriert.</h1>
            <Button link="/login">Anmelden</Button>
          {:else}
          <!-- <form on:submit|preventDefault={submit} class="tw-text-center tw-bg-slate-100 tw-p-8 tw-rounded-md">
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="username">Username</label>
                <input on:input={(evt)=>data.name = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="text" id="username" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.name}</span>
              </div>
            
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="email">Email</label>
                <input on:input={(evt)=>data.email = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="email" id="email" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.email}</span>
              </div>
            
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="password">Password</label>
                <input on:input={(evt)=>data.password = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="password" id="password" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.password}</span>
              </div>
            
              <div class="tw-flex tw-flex-col tw-w-full tw-mb-6">
                <label class="tw-text-lg tw-mb-2" for="password-confirm">Confirm Password</label>
                <input on:input={(evt)=>data.password_confirmation = evt.target.value} class="tw-border tw-border-gray-400 tw-rounded tw-w-full tw-py-2 tw-px-3" type="password" id="password-confirm" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.password_confirmation}</span>
              </div>

              <div class="tw-mb-4">
                <label for="acceptDataAgreements" class="tw-block tw-text-gray-700 tw-font-bold tw-mb-1">Accept <a class="tw-text-gray-700 hover:tw-text-black" href="https://www.krems.at/datenschutzerklaerung">Data Agreements</a></label>
                <input on:input={(evt)=>data.terms = evt.target.checked} type="checkbox" class="tw-mt-1" id="acceptDataAgreements" />
                <span class="tw-text-red-500 tw-text-sm tw-mt-1">{errors.terms}</span>
              </div>

              <SubmitButton>Create Account</SubmitButton>
            </form>

              <div class="tw-text-center tw-mt-2">
                <Link href="/login" class="tw-text-sm tw-text-gray-700 hover:tw-text-black">Anmelden</Link>
              </div> -->
            <FloatingForm name="Registrieren" {data} onSubmit={submit}></FloatingForm>
            <div class="tw-text-center tw-mt-2">
              <a class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="https://www.krems.at/datenschutzerklaerung">Datenschutzerklärung</a><br>
              <Link class="tw-text-sm tw-text-gray-700 hover:tw-text-black" href="/login">Anmelden</Link>
            </div>
        {/if}
      </div>
    </CenterDiv>
</Layout>