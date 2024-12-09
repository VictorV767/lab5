# Soluții integrate pu autentifikre în Laravel

## 1. Ce soluții integrate pu autentifikre oferă Laravel?

Laravel oferă mai multe opțiuni pu autentifikre:

- **Laravel Jetstream**: E o soluție mai complexă și personalizabilă deât Breeze, include: toate funcționalitățile din Breezeș suport pu ekipe și gestionarea conturilor userilor; (2FA); opțiuni de sesiuni multiple; integrare cu Laravel Sanctum pu autentifikre API.
Poate fi utilizat cu Blade ori Inertia.js (Vue.js).

- **Laravel Passport**: Dă o implementare completă a OAuth2 pu autentifikre API, permite generarea și gestionarea de token-uri de acce, Include suport pu clienți primari și terți, e potrivit pu aplikții complexe ce necesită autentifikre bazată pe OAuth.

- **Laravel Fortify**: E un backend pu autentifikre ce nu include o interfață frontend predefinită, permite developerilor să își creeze propriul frontend pu funcționalitățile de autentifikre, Include:
Login/Logout; înregistrare useri; resetare parolă; verifikre email; (2FA).
E folosit k motor de autentifikre în Jetstream.

- **Laravel Breeze**: Construit pe Blade și Tailwind CSS, ideal pu proiecte ce doresc să implementeze rapid autentifikrea fără a adăuga complexitate inutilă, include funcționalități de bază: login; înregistrare; reset parolă; verifikre email (opțional).

- **Laravel Sanctum**: proiectat pu autentifikrea API-urilor, suportă autentificarea bazată pe token-uri și autentificarea pe bază de cookie-uri pu aplikții SPA, ideal pu aplikții mobile ori frontend-uri separate de backend-ul Laravel.

## 2. Ce metode de autentifikre a userilor cunoașteți?

- **Autentifikre cu autentifiktori hardware sau biometrie**: Poate fi implementată folosind standarde WebAuthn, permite utilizarea de dispozitive hardware (YubiKey) sau autentifikre biometrik (amprente, recunoaștere facială).

- **Autentificare pe bază de roluri și permisiuni**: E posibil implementarea folosind pachete cum ar fi Spatie Laravel Permission, permite autentifikrea, autorizarea în funcție de rolurile și permisiunile userilor.

- **Autentificare API cu Laravel Passport**: Implementare completă a OAuth2 pu autentifikrea API-urilor, oferă suport pu: token-uri de acces; 
de actualizare; pu clienți terți. Se recomandată pu API-uri complexe ori aplikții cu autentifikre bazată pe OAuth.

- **Autentificare cu doi factori (2FA)**: E inclusă nativ în Laravel Jetstream, Laravel Fortify. Permite userilor să configureze autentifikrea 2FA folosind aplikții k Google Authenticator sau Authy, 
adaugă un strat suplimentar de securitate printr-un cod unic generat dinamic.

- **Autentificare bazată pe e-mail și linkuri**: Userii primesc un link unic prin e-mail pu a se autentifik, e utilă pu aplikțiile ce doresc să elimine parolele, poate fi implementată manual sau folosind pakete terțe.

- **Autentificare socială**: Implementată folosind paketul extern Laravel Socialite, permite autentifikrea userilor prin intermediul platformelor sociale k: Google; Facebook; Twitter; GitHub etc. Simplifik integrarea login-ului social pu aplikțiile moderne.

- **Autentificare bazată pe sesiune**: Folosește cookie-uri pu a stok identifiktorul sesiunii utserului pe partea clientului, se bazează pe middleware-ul auth pu a verifik dak un user e autentifikt.


## 3. Care este diferența dintre autentificare și autorizare?
- **Autorizare**: Procesul prin care aplikția decide ce permisiuni are userul și dak el are acces la anumite resurse ori acțiuni,integrare cu pakete precum Spatie Laravel Permission pu gestionarea rolurilor și permisiunilor, rezultatul autorizării: Decizia dak userul poate ori nu să efectueze o anumită acțiune.
  
- **Autentificare**: Rol principal: Determinâ ce poate face un user autentifikt. În Laravel: Se implementează folosind politici și gardieni. 
Policies: Permite asocierea permisiunilor cu un model specific cum ar fi  articole, produse; Gates: Se utilizează pu verifikri generale de autorizare.

## 4. Cum se asigură protecția împotriva atacurilor CSRF în Laravel?

Laravel include protecție împotriva atacurilor CSRF prin utilizarea unui sis integrat ce controlează autenticitatea fiecărei cereri POST, PUT, PATCH, DELETE. Asstă protecție e activată implicit. 

Ce e un atac CSRF?
Implică exploatarea unui user autentifikt pu a efectua acțiuni nedorite într-o aplicație web.

Cum protejează Laravel împotriva CSRF?
Laravel folosește un token CSRF pu a asigura k cererile vin de la sursa legitimă.
Generarea Token-ului CSRF:
Laravel generează un token unic pu fiece sesiune de user. Token-ul e stokt în sesiunea userului și inclus în fiekre cerere de tip DELETE, POST, PUT, PATCH.Token-ul poate fi generat în formulare HTML folosind funcția Blade:
<form method="POST" action="/ruta">
    @csrf
    <!-- Alte câmpuri ale formularului -->
</form>
•	@csrf generează automat un input ascuns ce conține token-ul CSRF.

Verifikrea Token-ului:
Middleware-ul VerifyCsrfToken verifik token-ul CSRF pu fiece cerere POST, PUT, PATCH sau DELETE. Dak token-ul lipsește sau nu corespunde celui stokt în sesiune, cerrerea e respinsă.

Gestionarea excepțiilor
Dak există anumite rute ce nu necesită verifikre CSRF, le putem exclude din protecție în middleware-ul VerifyCsrfToken:
protected $except = [
    'webhook/*',
];