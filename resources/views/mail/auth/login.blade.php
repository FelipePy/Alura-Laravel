<x-mail::message>
# Olá {{ $username }}!

Você acabou de realizar o login com o seguinte email:
## {{ $email }}

Caso não tenha sido você, considere alterar sua senha clicando no botão abaixo.

<x-mail::button :url="route('login')">
    Alterar senha
</x-mail::button>
<div align="center">
Caso você tenha realizado o login, desconsidere este e-mail.
</div>

</x-mail::message>
