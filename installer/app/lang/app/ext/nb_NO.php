<?php
$lang['action_freshen'] = 'Friske opp / reparere en CMSMS %s installasjon';
$lang['action_install'] = 'Opprette en ny CMSMS %s hjemmeside';
$lang['action_upgrade'] = 'Oppgrader en CMSMS Nettstedet til versjon %s';
$lang['advanced_mode'] = 'Aktiver avansert modus';
$lang['apptitle'] = 'Installasjon og oppgraderings assistent';
$lang['assets_dir_exists'] = 'Assets katalogen eksisterer';
$lang['available_languages'] = 'Tilgjengelige språk';
$lang['build_date'] = 'Byggedato';
$lang['changelog_uc'] = 'ENDRINGSLOGG';
$lang['cleaning_files'] = 'Rens for filer som ikke lenger er aktuelt for utgivelsen';
$lang['config_writable'] = 'Test for skrivbar config fil';
$lang['confirm_freshen'] = 'Er du sikker på at du ønsker å oppfriske (reparere) den eksisterende installasjonen av CMSMS. Bruk med ekstrem forsiktighet!';
$lang['confirm_upgrade'] = 'Er du sikker på at du vil starte oppgraderingsprosessen';
$lang['curl_extension'] = 'Sjekk for Curl utvidelsen';
$lang['create_assets_structure'] = 'Oppretter en lokasjon for fil ressurser';
$lang['database_support'] = 'Sjekk for kompatible database drivere';
$lang['desc_wizard_step1'] = 'Start installasjonen eller oppgraderings prosessen';
$lang['desc_wizard_step2'] = 'Analyse av mål katalog for å finne eksisterende software';
$lang['desc_wizard_step3'] = 'Sjekk for å være sikker på at alt er OK for å installere CMSMS core/kjernen';
$lang['desc_wizard_step4'] = 'For nye installasjoner, og oppfriskings handling, oppgi grunnleggende configurasjon info';
$lang['desc_wizard_step5'] = 'For nye installasjoner, oppgi administrasjonskonto info';
$lang['desc_wizard_step6'] = 'For nye installasjoner, oppgi grunnleggende nettstedsdetaljer';
$lang['desc_wizard_step7'] = 'Pakk ut filer';
$lang['desc_wizard_step8'] = 'Opprette eller oppdatere databaseskjemaet, sett innledende handlinger, tillatelser, brukerkontoer, maler, stilark og innhold';
$lang['desc_wizard_step9'] = 'Installer og/eller oppgrader moduler om nødvendig, skrive config-filen, og rydde opp.';
$lang['destination_directory'] = 'Målkatalog';
$lang['dest_writable'] = 'Skrive rettighet i målkatalogen';
$lang['disable_functions'] = 'Avslåtte funksjoner';
$lang['done'] = 'utført';
$lang['email_accountinfo_message'] = 'Din installasjon av CMS Made Simple er ferdig.

Denne e-posten inneholder sensitiv informasjon, og bør oppbevares på et sikkert sted.

Her er detaljene for din installasjon.
brukernavn: %s
passord: %s
installasjonskatalog: %s
root url: %s';
$lang['email_accountinfo_message_exp'] = 'Din installasjon av CMS Made Simple er ferdig.

Denne e-posten inneholder sensitiv informasjon, og bør oppbevares på et sikkert sted.

Her er detaljene for din installasjon.
brukernavn: %s
passord: %s
installasjonskatalog: %s';
$lang['email_accountinfo_subject'] = 'Installasjon av CMS Made Simple var vellykket';
$lang['emailaccountinfo'] = 'Send kontoinformasjonen via e-post';
$lang['emailaddr'] = 'E-postadresse';
$lang['error_adminacct_emailaddr'] = 'E-posten du oppgav er ugyldig';
$lang['error_adminacct_emailaddrrequired'] = 'Du har valgt å sende kontoinformasjonen, men har ikke lagt inn en gyldig e-postadresse';
$lang['error_adminacct_password'] = 'Passordet er ugyldig (må være minst seks tegn)';
$lang['error_adminacct_repeatpw'] = 'Passordene samsvarte ikke.';
$lang['error_adminacct_username'] = 'Brukernavnet er ugyldig. Vennligst prøv igjen';
$lang['error_admindirrenamed'] = 'Det ser ut til at av sikkerhetsmessige grunner så har du kanskje omdøpt din CMSMS admin katalog. Du må reversere <a href="http://docs.cmsmadesimple.org/general-information/securing-cmsms#renaming-admin-folder" target="_blank" class="external"> denne prosessen</a> for å fortsette!';
$lang['error_backupconfig'] = 'Vi kunne ikke skikkelig ta sikkerhetskopi av config-filen';
$lang['error_checksum'] = 'Utpakket fil checksum samsvarer ikke med original';
$lang['error_cmstablesexist'] = 'Det ser ut til at det allerede er en CMS installasjon på denne databasen. Vennligst oppgi annen databaseinformasjon. Hvis du ønsker å bruke en annen tabell prefix vil du måtte restarte installasjonsprosessen og aktivere avansert modus.';
$lang['error_createtable'] = 'Problem med å opprette databasetabell... mulig dette er et rettighetsproblem';
$lang['error_dbconnect'] = 'Vi kunne ikke koble til databasen. Vennligst dobbeltsjekk legitimasjonen du har oppgitt';
$lang['error_dirnotvalid'] = 'Katalogen %s finnes ikke (eller så er den ikke skrivbar)';
$lang['error_droptable'] = 'Problem fjerne databasetabell ... kanskje dette er et problem med tillatelser';
$lang['error_filenotwritable'] = 'Filen %s kunne ikke overskrives (tillatelses problem)';
$lang['error_internal'] = 'Beklager, noe har gått galt ... (intern feil) (%s)';
$lang['error_invalid_directory'] = 'Det ser ut til at den katalogen du har valgt å installere i er en arbeidskatalog for installatøren selv';
$lang['error_invalidconfig'] = 'Feil i config-filen, eller config fil mangler';
$lang['error_invaliddbpassword'] = 'Database passord inneholder ugyldige tegn som ikke trygt kan lagres.';
$lang['error_invalidkey'] = 'Ugyldig medlemsvariabel eller nøkkel %s for klasse %s';
$lang['error_invalidparam'] = 'Ugyldig parameter eller verdi for parameter: %s';
$lang['error_invalidtimezone'] = 'Tidssonen er ugyldig';
$lang['error_invalidqueryvar'] = 'Forespørselvariabelen inneholder ugyldige tegn. Bruk bare alfanumeriske tegn og understrek.';
$lang['error_missingconfigvar'] = 'Nøkkelen "%s" enten mangler eller er ugyldig i filen config.ini';
$lang['error_noarchive'] = 'Problem med å finne arkivfilen ... vennligst start på nytt';
$lang['error_nlsnotfound'] = 'Problemer med å finne NLS filer i arkivet';
$lang['error_nodatabases'] = 'Ingen kompatible database utvidelser ble funnet';
$lang['error_nodbhost'] = 'Vennligst skriv inn et gyldig vertsnavn (eller IP-adresse) for databasetilkoblingen';
$lang['error_nodbname'] = 'Vennligst skriv inn navnet på en gyldig database på verten angitt ovenfor';
$lang['error_nodbpass'] = 'Vennligst skriv inn et gyldig passord for å autentisere til databasen';
$lang['error_nodbprefix'] = 'Vennligst skriv inn et gyldig prefiks for databasetabeller';
$lang['error_nodbtype'] = 'Vennligst velg en database type';
$lang['error_nodbuser'] = 'Vennligst skriv inn et gyldig brukernavn for autentisering til databasen';
$lang['error_nodestdir'] = 'Målkatalog ikke satt';
$lang['error_nositename'] = 'Nettstedsnavn er en nødvendig parameter. Vennligst skriv inn et passende navn på ditt nettsted.';
$lang['error_notimezone'] = 'Vennligst skriv inn en gyldig tidssone for denne serveren';
$lang['error_overwrite'] = 'Tillatelsesproblem: kan ikke overskrive %s';
$lang['error_sendingmail'] = 'Feil ved sending av e-post';
$lang['error_tzlist'] = 'Et problem oppstod med å hente listen med tidssone identifikatorer';
$lang['errorlevel_estrict'] = 'Tester for E_STRICT';
$lang['errorlevel_edeprecated'] = 'Tester for E_DEPRECATED';
$lang['edeprecated_enabled'] = 'E_DEPRECATED er aktivert i PHP\'s error_reporting. Selv om dette ikke vil hindre CMSMS fra drift kan det resultere i at advarsler blir vist i utdataene. Spesielt fra eldre tredjeparts moduler';
$lang['estrict_enabled'] = 'E_STRICT er aktivert i PHP\'s error_reporting. Selv om dette ikke vil hindre CMSMS fra drift, kan det resultere i advarsler blir vist i HTML-visning. Spesielt fra eldre tredjeparts moduler';
$lang['fail_assets_dir'] = 'En eiendel katalog finnes allerede. Dette programmet kan skrive til denne katalogen for å rasjonere plasseringen av filene. Vennligst sørg for at du har en sikkerhetskopi';
$lang['fail_assets_msg'] = 'En eiendeler katalog finnes allerede. Denne applikasjonen kan skrive til denne katalogen for å rasjonalisere plasseringen av filer. Sørg for at du har en sikkerhetskopi';
$lang['fail_config_writable'] = 'HTTP-prosessen kan ikke skrive til config.php filen. Vennligst prøv å endre tillatelsene på denne filen til 777 inntil oppgraderingen er fullført';
$lang['fail_curl_extension'] = 'Curl utvidelsen er ikke funnet. Selv om ikke dette er et kritisk problem så kan dette føre til problemer med enkelte tredjeparts moduler';
$lang['fail_database_support'] = 'Ingen Kompatible database drivere funnet';
$lang['fail_file_get_contents'] = 'file_get_contents funksjonen finnes ikke, eller er deaktivert. CMSMS Kan ikke fortsette (selv installasjonsprogrammet vil sannsynligvis mislykkes)';
$lang['fail_file_uploads'] = 'Opplasting funksjoner er deaktivert i dette miljøet. Flere funksjoner i CMSMS vil ikke fungere i dette miljøet';
$lang['fail_func_json'] = 'json funksjonalitet ble ikke funnet';
$lang['fail_func_gzopen'] = 'gzopen funkjson ble ikke funnet';
$lang['fail_func_md5'] = 'md5 funksjonalitet ble ikke funnet';
$lang['fail_func_tempnam'] = 'tempnam funksjonen finnes ikke. Dette er en nødvendig funksjon for CMSMS funksjonaliteten';
$lang['fail_func_ziparchive'] = 'ZipArchive funksjonalitet ble ikke funnet. Dette kan begrense funksjonaliteten';
$lang['fail_ini_set'] = 'Det ser ut til at vi ikke kan endre ini innstillinger. Dette kan føre til problemer i tredjeparts moduler (eller ved aktivering av debug-modus)';
$lang['fail_intl_support'] = 'PHP internasjonaliseringsutvidelse er ikke tilgjengelig';
$lang['fail_magic_quotes_runtime'] = 'Det ser ut til at magic quotes(/magiske sitater) er aktivert i konfigurasjonen. Vennligst deaktivere dette og prøv på nytt';
$lang['fail_max_execution_time'] = 'Din maks Execution time på %s oppfyller ikke minimumsverdien på %s. Vi anbefaler deg å øke det til %s eller høyere';
$lang['fail_memory_limit'] = 'Memory Limit grenseverdien er for lav. Du hadde %s, men et minimum på %s er nødvendig, og %s er anbefalt';
$lang['fail_multibyte_support'] = 'Multibyte støtte er ikke aktivert i din konfigurasjon';
$lang['fail_output_buffering'] = 'Output Buffering(/Mellomlagring av utdata) er ikke aktivert.';
$lang['fail_open_basedir'] = 'Open basedir restriksjoner er i kraft. CMSMS krever at dette skal være deaktivert';
$lang['fail_php_version'] = 'Versjonen av PHP tilgjengelig for CMSMS er av kritisk betydning. Minste aksepterte versjonen er %s, men vi anbefaler %s eller høyere. Du har %s';
$lang['fail_post_max_size'] = 'Din Post max size(/innlegg maks størrelse) på %s oppfyller ikke minimumsverdien på %s. Du må øke til påkrevd minimum. Men du bør øke den til %s og også sikre at det er større enn upload_max_filesize';
$lang['fail_pwd_writable2'] = 'HTTP-prosessen må være i stand til å skrive til destinasjons katalogen (og til alle filer og kataloger under den) for å installere filer. Vi har ikke skrivetilgang til (minst) %s';
$lang['fail_register_globals'] = 'Vennligst deaktiver Register Globals i din PHP konfigurasjon';
$lang['fail_remote_url'] = 'Vi fikk problemer med å koble til en ekstern URL. Dette vil begrense noe av funksjonaliteten i CMS Made Simple';
$lang['fail_safe_mode'] = 'CMSMS vil ikke fungere skikkelig i et miljø hvor sikkermodus er aktivert. Bare så dere vet: Sikkermodus er foreldet som en mislykket mekanisme, og vil bli fjernet i fremtidige versjoner av PHP';
$lang['fail_session_save_path_exists'] = 'Session save path variabelverdien er ugyldig eller mappen finnes ikke';
$lang['fail_session_save_path_writable'] = 'Session save path katalogen er ikke skrivbar';
$lang['fail_session_use_cookies'] = 'Sessijoner er IKKE satt til å benytte cookies';
$lang['fail_tmpfile'] = 'Systemets tmpfile() -funksjon fungerer ikke. Dette er nødvendig for å tillate oss å trekke ut arkiver. Det valgfrie TMPDIR url argumentet kan gis for installasjonsprogrammet for å spesifisere en skrivbar katalog. Se README-filen som bør være i inkludert i denne katalogen.';
$lang['fail_tmp_dirs_empty'] = 'De CMSMS Midlertidige kataloger <em>(tmp/cache and tmp/templates_c) eksisterer, og er ikke tom. Vennligst fjern eller tømme dem';
$lang['fail_xml_functions'] = 'XML utvidelsen ble ikke funnet. Vennligst aktiver dette i ditt PHP miljø';
$lang['failed'] = 'feilet';
$lang['file_get_contents'] = 'Testing av file_get_contents funksjonen';
$lang['file_installed'] = 'Installert %s';
$lang['file_uploads'] = 'Testing for filopplasting støtte';
$lang['finished_custom_freshen_msg'] = 'Installasjonen har blitt oppfrisket! Kjerne filene har blitt oppdatert, og en ny config-fil er opprettet. Vennligst besøk nettstedet ditt for å forsikre at alt fungerer som det skal';
$lang['finished_custom_install_msg'] = 'Hva! Vi er klare. Vennligst besøk nettstedet og logg inn i administrasjonspanelet';
$lang['finished_custom_upgrade_msg'] = 'Hva! Alt er ferdig. Vennligst besøk ditt CMSMS Admin panel, og frontend for å sikre at alt fungerer som det skal <br/><strong> Hint: </strong> Nå er et godt tidspunkt å ta en ny backup.';
$lang['finished_freshen_msg'] = 'Installasjonen har blitt oppfrisket! Kjerne filene har blitt oppdatert, og en ny config-filen er opprettet. Du kan nå <a href="%s">besøke nettstedet ditt</a> eller logge inn på <a href="%s">CMSMS Admin panelet</a>.';
$lang['finished_install_msg'] = 'Hva! Vi er klare. Du kan nå <a href="%s">besøke nettstedet ditt</a> eller logge inn på <a href="%s">CMSMS admin panelet</a>.';
$lang['finished_upgrade_msg'] = 'Hva! Alt er klart. Vennligst besøk ditt <a href="%s">nettsteds frontend</a> og <a href="%s">Admin panel</a> for å verifisere korrekt oppførsel. Du må kanskje også oppgradere noen tredjeparts moduler <br/><strong>Hint:</strong> Husk å ta en ny backup etter å ha kontrollert korrekt oppførsel.';
$lang['freshen'] = 'Oppfriske (reparere) installasjon';
$lang['func_json'] = 'Sjekke for JSON koding og dekoding';
$lang['func_md5'] = 'Sjekke for md5 funksjonalitet';
$lang['func_tempnam'] = 'Sjekk for tempnam funksjon';
$lang['func_gzopen'] = 'Sjekk for gzopen funksjon';
$lang['func_ziparchive'] = 'Sjekk for ziparchive funksjon';
$lang['gd_version'] = 'GD versjon';
$lang['goback'] = 'Tilbake';
$lang['info_addlanguages'] = 'Velg språk (i tillegg til engelsk) som skal installeres. <strong>Merk:</strong> ikke alle oversettelser er fullført.';
$lang['info_adminaccount'] = 'Vennligst oppgi legitimasjon for den første administratorkontoen. Denne kontoen vil ha tilgang til all funksjonalitet i CMSMS admin konsollen.';
$lang['info_advanced'] = 'Avansert modus gir flere alternativer i installasjonsprosedyren.';
$lang['info_dbinfo'] = 'CMS Made Simple lagrer mye data i databasen. En database tilkobling er obligatorisk. I tillegg bør den brukerlegitimasjonen du leverer har alle privilegier på den angitte databasen for å tillate oppretting, sletting og endring av tabeller, indekser og visninger.';
$lang['info_errorlevel_edeprecated'] = 'E_DEPRECATED er et flagg for php\'s feilrapportering som indikerer at advarsler skal vises om kode som bruker utdaterte teknikker. For CMSMS kjernen forsøker vi å sikre at vi ikke lenger bruker utdaterte teknikker, noen moduler kanskje ikke følger opp dette. Vi anbefaler at denne innstillingen deaktiveres i PHP-konfigurasjonen';
$lang['info_errorlevel_estrict'] = 'E_STRICT er et flagg for php\'s feilrapportering som viser at strenge kodestandarder bør respekteres. Selv om CMSMS kjernen forsøker å samsvare med E_STRICT standarder så mulig enkelte moduler ikke er det. Vi anbefaler at denne innstillingen deaktiveres i PHP-konfigurasjonen';
$lang['info_installcontent'] = 'Som standard vil dette installasjonsprogrammet skape en rekke eksempler på sider, stilark og maler i CMSMS. Prøveinnholdet gir omfattende informasjon og tips til hjelpe i å bygge nettsteder med CMSMS og er nyttig å lese. Hvis du allerede er kjent med CMS Made Simple så vil deaktivering av dette alternativet vil bare opprette et minimalt sett med maler, stilark og innholdssider.';
$lang['info_open_basedir_session_save_path'] = 'open_basedir er aktivert i din PHP konfigurasjon. Vi kunne ikke skikkelig teste session evner. Men det å komme til dette punktet i installasjonsprosessen indikerer trolig at øktene jobber greit.';
$lang['info_pwd_writable'] = 'Denne applikasjonen krever skrivetilgang til gjeldende arbeidskatalog';
$lang['info_queryvar'] = 'Spørringsvariabelen brukes internt av CMSMS for å identifisere den forespurte siden. I de fleste tilfeller har du ikke behov for å endre denne.';
$lang['info_sitename'] = 'Nettstedsnavnet brukes i standardmaler som en del av tittelen. Vennligst skriv inn et lesbart navn for nettstedet';
$lang['info_timezone'] = 'Tidssone informasjon er nødvendig for tidsberegning og tid/datovisning. Vennligst velg server tidssone';
$lang['ini_set'] = 'Test om vi kan endre INI-instillinger';
$lang['install'] = 'Installer';
$lang['install_attachstylesheets'] = 'Koble stilark til tema';
$lang['install_backupconfig'] = 'Sikkerhetskopierer config-filen';
$lang['install_createassets'] = 'Opprett eiendel struktur';
$lang['install_created_index'] = 'Opprettet indeks %s ... %s';
$lang['install_create_tables'] = 'Oppretter database tabeller';
$lang['install_createconfig'] = 'Oppretter ny config-fil';
$lang['install_createcontentpages'] = 'Oppretter nye innholdssider';
$lang['install_created_table'] = 'Opprettet tabell %s: .... %s';
$lang['install_createtablesindexes'] = 'Oppretter tabeller og indekser';
$lang['install_createtmpdirs'] = 'Oppretter midlertidige kataloger';
$lang['install_creating_index'] = 'Opprettet indeks %s';
$lang['install_default_collections'] = 'Installer standard samlinger';
$lang['install_defaultcontent'] = 'Installer standard innhold';
$lang['install_detectlanguages'] = 'Oppdag installerte språk';
$lang['install_dropping_tables'] = 'Fjern tabeller';
$lang['install_dummyindexhtml'] = 'Opprett dummy index.html filer';
$lang['install_extractfiles'] = 'Pakk ut filer fra arkivet';
$lang['install_initevents'] = 'Opprett hendelser';
$lang['install_initsitegroups'] = 'Opprett innledende grupper';
$lang['install_initsiteperms'] = 'Sett innledende rettigheter';
$lang['install_initsiteprefs'] = 'Sett innledende nettsteds-innstillinger';
$lang['install_initsiteusers'] = 'Opprett innledende brukerkontoer';
$lang['install_initsiteusertags'] = 'Innledende brukerdefinerte tagger';
$lang['install_module'] = 'Installer modul %s';
$lang['install_modules'] = 'Installer tilgjengelige moduler';
$lang['install_passwordsalt'] = 'Sett passord salting';
$lang['install_requireddata'] = 'Sett innledende påkrevd data';
$lang['install_schema'] = 'Opprett database sjema';
$lang['install_setschemaver'] = 'Sett skjema versjon';
$lang['install_setsequence'] = 'Tilbakestill sekvens tabeller';
$lang['install_setsitename'] = 'Sett nettstedsnavn';
$lang['install_stylesheets'] = 'Opprett standard stilark';
$lang['install_templates'] = 'Opprett standaard maler';
$lang['install_templatetypes'] = 'Opprett standard maltyper';
$lang['install_update_sequences'] = 'Oppdater sekvens tabeller';
$lang['install_updatehierarchy'] = 'Oppdater innholdets hierarkiposisjoner';
$lang['install_updateseq'] = 'Oppdater sekvens for %s';
$lang['installer_ver'] = 'Installer versjon';
$lang['intl_support'] = 'Se etter internasjonaliseringsevner';
$lang['legend'] = 'Forklaring';
$lang['magic_quotes_runtime'] = 'Forsikrer oss om at magiske sitater er deaktivert';
$lang['max_execution_time'] = 'Kontrollere PHP-script maks Utføringstid';
$lang['meaning'] = 'Betydning';
$lang['memory_limit'] = 'Sjekker for tilstrekkelig PHP minnegrense';
$lang['msg_clearedcache'] = 'Tømte serverens mellomlager';
$lang['msg_configsaved'] = 'Eksisterende config-fil lagret til %s';
$lang['msg_upgrade_module'] = 'Oppgraderer mdodul %s';
$lang['msg_upgrademodules'] = 'Oppgraderer moduler';
$lang['msg_yourvalue'] = 'Du har: %s';
$lang['multibyte_support'] = 'Sjekker for multibyte støtte';
$lang['next'] = 'Neste';
$lang['no'] = 'Nei';
$lang['none'] = 'Ingen';
$lang['open_basedir'] = 'open_basedir restriksjoner';
$lang['open_basedir_session_save_path'] = 'open_basedir er aktivert. Kan derfor ikke teste session save path.';
$lang['output_buffering'] = 'Forsikrer oss om at output buffering er slått på';
$lang['pass_config_writable'] = 'HTTP-prosessen har skriverettighet til config-filen';
$lang['pass_database_support'] = 'Minst en kompatibel database driver er funnet';
$lang['pass_func_json'] = 'json funksjonalitet oppdaget';
$lang['pass_func_md5'] = 'md5 funksjonalitet er oppdaget';
$lang['pass_func_tempnam'] = 'tempnam funksjonen sksisterer';
$lang['pass_intl_support'] = 'Internasjonaliseringsevner ser ut til å være aktivert';
$lang['pass_memory_limit_nolimit'] = 'Det er ingen forhåndsinnstilte PHP minnegrense';
$lang['pass_multibyte_support'] = 'Multibyte støtte ser ut til å være slått på';
$lang['pass_php_version'] = 'PHP versjonen som er konfigurert oppfyller ikke minimumskravene. Som et minimum er PHP %s nødvendig, men vi anbefaler %s eller høyere';
$lang['pass_pwd_writable'] = 'HTTP-prosessen kan skrive i destinasjons katalogen. Dette er nødvendig for ekstrahere filer';
$lang['password'] = 'Passord';
$lang['ph_sitename'] = 'Oppgi ett nettstedsnavn';
$lang['php_version'] = 'PHP versjon';
$lang['post_max_size'] = 'Sjekker den maksimale mengden av data som kan bli sendt i en forespørsel';
$lang['prompt_addlanguages'] = 'Andre språk';
$lang['prompt_createtables'] = 'Oppretter databasetabeller';
$lang['prompt_dbhost'] = 'Database vertsnavn';
$lang['prompt_dbinfo'] = 'Database informasjon';
$lang['prompt_dbname'] = 'Databasenavn';
$lang['prompt_dbpass'] = 'Passord';
$lang['prompt_dbport'] = 'Database portnummer';
$lang['prompt_dbprefix'] = 'Database tabellnavn prefiks';
$lang['prompt_dbtype'] = 'Databasetype';
$lang['prompt_dbuser'] = 'Brukernavn';
$lang['prompt_dir'] = 'Installasjonskatalog';
$lang['prompt_installcontent'] = 'Installer eksempelinnhold';
$lang['prompt_queryvar'] = 'Spørringsvariabel';
$lang['prompt_sitename'] = 'Nettstedsnavn';
$lang['prompt_timezone'] = 'Server tidssone';
$lang['pwd_writable'] = 'Katalog skrivbar';
$lang['queue_for_upgrade'] = 'Lagt i kø ikke kjerne modul %s for oppgradering på neste trinn.';
$lang['readme_uc'] = 'LESMEG';
$lang['register_globals'] = 'Forsikrer oss om at "register globals" er deaktivert';
$lang['remote_url'] = 'Urgående HTTP koblinger';
$lang['repeatpw'] = 'Gjenta passord';
$lang['reset_site_preferences'] = 'Tilbakestill noen nettstedspreferanser';
$lang['reset_user_settings'] = 'Tilbakestill bruker preferanser';
$lang['retry'] = 'Forsøk igjen';
$lang['safe_mode'] = 'Test for å sikre "safe mode" er deaktivert';
$lang['saltpasswords'] = 'Salt passord';
$lang['select_language'] = 'Det første vi vil be deg om å gjøre er å velge språk fra listen nedenfor. Dette vil bli brukt til å forbedre din opplevelse under installasjonen, men vil ikke påvirke din CMSMS installasjon.';
$lang['send_admin_email'] = 'Send admin påloggingsinformasjon e-post';
$lang['session_capabilities'] = 'Teste for riktige sesjons evner (økter bruker cookies og session save path er skrivbar, osv.)';
$lang['session_save_path_exists'] = 'Session_save_path eksisterer';
$lang['session_save_path_writable'] = 'Session_save_path er skrivbar';
$lang['session_use_cookies'] = 'Forsikrer oss om at PHP sesjoner benytter cookies';
$lang['sometests_failed'] = 'Vi har utført en rekke tester av din nåværende web-miljø. Selv om ingen kritiske spørsmål ble funnet, anbefaler vi at følgende elementer rettes opp før du fortsetter.';
$lang['step1_advanced'] = 'Avansert modus';
$lang['step1_destdir'] = 'Velg katalog';
$lang['step1_info_destdir'] = '<strong>Advarsel:</strong> Dette programmet kan installere eller oppgradere flere installasjoner av CMS Made Simple. Det er viktig at du velger riktig katalog for installasjon eller oppgradering.';
$lang['step1_language'] = 'Velg språk';
$lang['step1_title'] = 'Velg språk';
$lang['step2_cmsmsfound'] = 'En installasjon av CMS Made Simple ble funnet. Det er mulig å oppgradere denne installasjonen. Men før du går videre påse at du har en gjeldende, verifisert sikkerhetskopi av alle filer og av databasen';
$lang['step2_cmsmsfoundnoupgrade'] = 'Selv om en installasjon av CMS Made Simple ble funnet, er det ikke mulig å oppgradere denne versjonen ved hjelp av dette programmet. Versjonen kan være for gammel.';
$lang['step2_confirminstall'] = 'Er du sikker på at du vil installere CMS Made Simple';
$lang['step2_confirmupgrade'] = 'Er du sikker på at du vil oppgradere CMS Made Simple';
$lang['step2_errorsamever'] = 'Den valgte katalogen ser ut til å inneholde en CMSMS installasjon med den samme versjonen som er inkludert i dette skriptet. Å fortsette vil oppfriske installasjonen.';
$lang['step2_errortoonew'] = 'Den valgte katalogen ser ut til å inneholde en CMSMS installasjon med en nyere versjon enn som er inkludert i dette skriptet. Vi kan ikke fortsette';
$lang['step2_info_freshen'] = 'Oppfriske installasjonen innebærer utskifting av alle kjernefiler og gjenskape konfigurasjonen. Du vil bli bedt om grunnleggende konfigurasjonsinformasjon, men databasen vil ikke bli berørt.';
$lang['step2_installdate'] = 'Omtrentlig installajsonsdato';
$lang['step2_install_dirnotempty2'] = 'Denne mappen inneholder allerede noen filer og / eller under-mapper . Selv om det er mulig å installere CMSMS her, kan det vertikalantenne korrupte-re et eksisterende program. Vennligst dobbeltsjekke innholdet i denne mappen. For referanseformål noen av filene er listet opp nedenfor. Sørg for at dette er riktig.';
$lang['step2_hdr_upgradeinfo'] = 'Versjonsinformasjon';
$lang['step2_info_upgradeinfo'] = 'Nedenfor er de tilgjengelige versjonsmerknadene, og endrings informasjon for hver utgivelse. Knappene under vil vise detaljert informasjon om hva som har endret seg i hver versjon av CMS Made Simple. Det kan være flere instruksjoner eller advarsler i hver versjon som kan påvirke oppgraderingsprosessen.';
$lang['step2_minupgradever'] = 'Den minste versjonen som dette programmet kan oppgradere fra er: %s. Du må kanskje oppgradere programmet ditt til en nyere versjon i etapper, med en annen metode før du fullfører oppgraderingen. Sørg for at du har en komplett, verifisert backup før du bruker noen oppgraderingsmetoden.';
$lang['step2_nocmsms'] = 'Vi fant ikke en installasjon av CMS Made Simple i denne katalogen. Det ser ut som dette er en ny installasjon';
$lang['step2_nofiles'] = 'Som forespurt, CMSMS kjernefiler vil ikke bli behandlet i denne prosessen';
$lang['step2_passed'] = 'Bestått';
$lang['step2_pwd'] = 'Din nåværende arbeidskatalog';
$lang['step2_schemaver'] = 'Database skjemaversjon';
$lang['step2_version'] = 'Din versjon';
$lang['step3_failed'] = 'Denne pakken har utført en rekke tester av php miljø, og en eller flere av disse testene har mislyktes. Du trenger å rette disse feilene i konfigurasjonen før du fortsetter. Når du har rettet opp feilene, klikk "Prøv på nytt" nedenfor.';
$lang['step3_passed'] = 'Denne pakken har utført en rekke tester av php miljø, og de ​​har alle bestått. Dette er gode nyheter. Selv om dette ikke er en avgjørende test. Du bør ikke ha noen problemer med å kjøre denne Core-installasjonen av CMSMS.';
$lang['step9_get_help'] = 'Koble til andre CMSMS-utviklere og få hjelp på følgende måter';
$lang['step9_get_support'] = 'Støttekanaler';
$lang['step9_join_community'] = 'Bli med i fellesskapet vårt';
$lang['step9_love_cmsms'] = 'Love CMS Made Simple';
$lang['step9_removethis'] = '<strong>Advarsel</strong> Av sikkerhetsmessige grunner er det viktig at du fjerner installasjons assistenten fra ditt nettsted så snart du har bekreftet at operasjonen var vellykket.';
$lang['step9_support_us'] = 'Klikk her for å finne ut hvordan du kan støtte oss';
$lang['symbol'] = 'Symbol';
$lang['social_message'] = 'Du har nå vellykket installert CMS Made Simple';
$lang['test_failed'] = 'En påkrevd Test mislyktes';
$lang['test_passed'] = 'En test er bestått <em>(beståtte tester vises bare i avansert modus) </em>';
$lang['test_warning'] = 'En innstilling er over påkrevd verdi, men under anbefalt verdi, eller ... <br />En evne som kan være nødvendig for noe ekstra funksjonalitet er ikke tilgjengelig';
$lang['th_status'] = 'Status';
$lang['th_testname'] = 'Test';
$lang['th_value'] = 'Verdi';
$lang['title_error'] = 'Houston, Vi har et problem!';
$lang['title_step2'] = 'Steg 2 - Oppdag eksisterende programvare';
$lang['title_step3'] = 'Steg 3 - Tester';
$lang['title_step4'] = 'Steg 4 - Grunnleggende konfigurasjonsinformasjon';
$lang['title_step5'] = 'Steg 5 - Admin kontoinformasjon';
$lang['title_step6'] = 'Steg 6 - Nettstedsinnstillinger';
$lang['title_step7'] = 'Steg 7 - Installerer programfiler';
$lang['title_step8'] = 'Steg 8 - Databasearbeid';
$lang['title_step9'] = 'Steg 9 - Avslutning';
$lang['title_welcome'] = 'Velkommen';
$lang['title_forum'] = 'Supportforum';
$lang['title_docs'] = 'Offisiell Dokumentasjon';
$lang['title_api_docs'] = 'Offisiell API Dokumentasjon';
$lang['to'] = 'til';
$lang['title_share'] = 'Del din erfaring med dine venner';
$lang['tmpfile'] = 'Sjekker for fungerende tmpfile()';
$lang['tmp_dirs_empty'] = 'Forsikre deg om at midletidige kataloger er tomme eller at de ikke eksisterer';
$lang['upgrade'] = 'Oppgrader';
$lang['upgrade_deleteoldevents'] = 'Slett gamle handlinger';
$lang['upgrading_schema'] = 'Oppdaterer databaseskjema';
$lang['upload_max_filesize'] = 'Tester maksimum størrelse på opplastede filer';
$lang['username'] = 'Brukernavn';
$lang['warn_disable_functions'] = 'Merk: en eller flere av PHP kjernefunksjonene er deaktivert. Dette kan ha negativ innvirkning på din CMSMS installasjon, spesielt med tredjeparts utvidelser. Vennligst hold et øye med feilloggen. Dine avslåtte funksjoner er:<br/><br/>%s';
$lang['warn_max_execution_time'] = 'Selv om din maks Execution time på %s overstiger minsteverdien på %s så anbefaler vi deg å øke det til %s eller høyere';
$lang['warn_memory_limit'] = 'Din Minne grenseverdi er %s, som er over minimum %s. Men %s anbefales';
$lang['warn_open_basedir'] = 'open_basedir er aktivert i din PHP konfigurasjon. Selv om du kan fortsette, CMSMS støtter ikke installasjoner med open_basedir restriksjoner.';
$lang['warn_post_max_size'] = 'Ditt post max size verdi er %s, som er over minimummet på %s, men %s er anbefalt. Også, så må du kontrollere at denne verdien er større enn upload_max_filesize';
$lang['warn_tests'] = '<strong>Merk:</strong> å ha bestått alle disse tester bør sørge for at CMSMS fungerer riktig på de fleste områder. Men, som nettstedet vokser og mer funksjonalitet legges til kan disse minimale verdier bli utilstrekkelige. I tillegg kan tredjeparts moduler ha ytterligere krav for å fungere skikkelig';
$lang['warn_upload_max_filesize'] = 'Selv om din innstilling av %s er tilstrekkelig, anbefaler vi at du øker upload_max_filesize innstillingen i PHP til minst %s';
$lang['welcome_message'] = 'Velkommen! Dette er CMS Made Simple\'s automatiske installasjons mekanisme. Denne pakken vil tillate deg å raskt og enkelt bekrefte at webhotellet er kompatibel med CMSMS og å installere eller oppgradere til den nyeste versjonen av CMS Made Simple. <br /> Vi vet at du vil nyte det.';
$lang['wizard_step1'] = 'Velkommen';
$lang['wizard_step2'] = 'Oppdag eksisterende programvare';
$lang['wizard_step3'] = 'Kompatibilitetstester';
$lang['wizard_step4'] = 'Konfigurasjonsinformasjon';
$lang['wizard_step5'] = 'Admin kontoinformasjon';
$lang['wizard_step6'] = 'Nettsted innstillinger';
$lang['wizard_step7'] = 'Filer';
$lang['wizard_step8'] = 'Database arbeid';
$lang['wizard_step9'] = 'Avslutt';
$lang['xml_functions'] = 'Tester for CML funksjonalitet';
$lang['yes'] = 'Ja';
?>