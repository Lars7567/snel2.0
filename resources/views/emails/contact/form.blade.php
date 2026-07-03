@component('mail::message')
# Nieuw contactformulier bericht

**Bedrijf:** {{ $data['bussiness'] ?? 'n.v.t.' }}

**Aanhef:** {{ ucfirst($data['callname']) }}

**Naam:** {{ $data['name'] }}

**Email:** {{ $data['email'] }}

---

**Bericht:**

{{ $data['message'] }}

@endcomponent
