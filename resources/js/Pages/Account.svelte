<script>
    import { page, router } from '@inertiajs/svelte';
    import AccLayout from "../Shared/AccLayout.svelte";
    import InfoText from '../Shared/InfoText.svelte';
    import Button from '../Shared/Button.svelte';
    import Form from '../Shared/Form.svelte';
    import H1 from "../Shared/H1.svelte";
    
    $: user = $page.props.auth.user;
    let editing = false;
    let editingPassword = false;
    $: userArray = [
      {
        name: 'Benutzername',
        value: user.NAME,
        bind: 'NAME',
        type: 'text',
        errorname: 'NAME',
        error: ''
      },
      {
        name: 'E-Mail',
        value: user.EMAIL,
        bind: 'EMAIL',
        type: 'string',
        errorname: 'EMAIL',
        error: ''
      }
    ];
    $: passwordArray = [
      {
        name: 'Altes Passwort',
        value: '',
        bind: 'OLD_PASSWORD',
        type: 'password',
        errorname: 'OLD_PASSWORD',
        error: ''
      },
      {
        name: 'Neues Passwort',
        value: '',
        bind: 'PASSWORD',
        type: 'password',
        errorname: 'PASSWORD',
        error: ''
      },
      {
        name: 'Neues Passwort wiederholen',
        value: '',
        bind: 'PASSWORD_CONFIRMATION',
        type: 'password',
        errorname: 'PASSWORD_CONFIRMATION',
        error: ''
      }
    ];

    function deleteAccount()
    {
        if(confirm("Möchten Sie Ihren Account wirklich löschen?"))
        {
            axios.post('/account/delete', {})
            .then(response => {
                if (response.status === 200) {
                  router.reload();
                }
            });
        }
    }

    let cancel = () => {
        editing = false;
        editingPassword = false;
    }

    let resetPassword = () => {
      let submitdata = passwordArray.map(element => {
        if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
          return {
              [element["bind"]]: element["value"]
          }
        }
      }).reduce((a, b) => Object.assign(a, b), {});

      axios.post('/password/change', submitdata)
      .then(response => {
          if (response.status === 200) {
            cancel();
            passwordArray.forEach(element => {
              element["error"] = "";
              element["value"] = "";
            });
          }
      })
      .catch(error => {
        console.log(error);
        if (error?.response?.status === 422) {
          for (const [key, value] of Object.entries(passwordArray)) {
            if(error.response.data.errors[value["errorname"]]) {
              passwordArray[key]["error"] = error.response.data.errors[value["errorname"]][0];
            } else {
              passwordArray[key]["error"] = "";
            }
          }
        }
      });
    }

    let submit = () => {
      let submitdata = userArray.map(element => {
        if(element["value"] !== "" && element["value"] !== "NaN-NaN-NaNTNaN:NaN" && element["value"] !== null) {
            return {
                [element["bind"]]: element["value"]
            }
          }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.post('/account', submitdata)
        .then(response => {
            if (response.status === 200) {
              userArray.forEach(element => {
                element["error"] = "";
              });
              cancel();
              router.reload();
            }
        })
        .catch(error => {
          console.log(error);
          if (error?.response?.status === 422) {
            for (const [key, value] of Object.entries(userArray)) {
                if(error.response.data.errors[value["errorname"]]) {
                  userArray[key]["error"] = error.response.data.errors[value["errorname"]][0];
                } else {
                  userArray[key]["error"] = "";
                }
            }
          }
        });
    }
</script>

<AccLayout>
  {#if editing}

    <H1 mb={false}>Benutzerdaten ändern</H1>
    <div class="tw-border-b tw-mb-3"></div>
    <Form newInstance={true} data={userArray} onCancel={cancel} onSubmit={submit}></Form>

  {:else if editingPassword}

    <H1 mb={false}>Passwort ändern</H1>
    <div class="tw-border-b tw-mb-3"></div>
    <Form newInstance={true} data={passwordArray} onCancel={cancel} onSubmit={resetPassword}></Form>

    {:else}

    <H1 mb={false}>Willkommen <span class="tw-text-yellow-400">{user.NAME}</span>!</H1>
    <div class="tw-flex tw-gap-2 tw-flex-col-reverse">
      <div>
        <InfoText color="light">E-Mail</InfoText>
        <div class="tw-mx-1 tw-inline">
          {user.EMAIL}
        </div>
        {#if !user.IS_EMAIL_VERIFIED}
            <Button size="small" link="/account/verify"><div class="tw-mx-2">Jetzt bestätigen</div></Button>
        {/if}
      </div>
      <div>
        <InfoText color="light">Benutzername</InfoText>
        <div class="tw-mx-1 tw-inline">
          {user.NAME}
        </div>
      </div>
    </div>
    <div class="tw-border-b tw-my-3"></div>
    <div class="tw-grid tw-gap-2 md:tw-grid-cols-3">
        <Button onClick={()=>editing = true}><i class="bi bi-pencil-fill"></i> Benutzerdaten ändern</Button>
        <Button onClick={()=>editingPassword = true}><i class="bi bi-key-fill"></i> Passwort ändern</Button>
        <Button type='danger' onClick={deleteAccount}><i class="bi bi-trash-fill"></i> Account löschen</Button>
    </div>
  {/if}
</AccLayout>