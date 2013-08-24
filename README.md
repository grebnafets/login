login
=====

This is just a simple login idea that is a little different from others and it is still under development.
I am learning as I develop new things.
My hope is to get feedback from more experienced programmers; learn and get from "entry level" to "junior level" in programming.


Þetta er í þróun hjá mér, reyndar er þetta hálfsárs gamall kóði sem ég er að dusta rikið af.

Hugmyndin á bak við þetta kerfi er eftirfarandi.

"Clientin" ætlar að skrá sig inn og þá byrtist honum rammi með mismunandi tölustöfum.

"Clientin" hefur sitt eigið fast lykilnúmer sem geymist þá í gagnagrunni og er ruglað með sha512 "algorithmanum".
Hér er það bara geymt sem texta skrá undir admin/assets og valdi ég lykilorðið "pass".

Svo er það breytilega lykilorðið sem myndi þá líka geimast í gagnagrunni en ekki ruglað.
Það vísar svo í hólfin í "cartesian" líku plani þar sem réttu númerin eru geymd.

Ég valdi lyklana 9 10 10 10 eða (y9,x10) og (y10,x10); athugaðu að "y" ásin er fyrstur, svo "x" ásin.

Ég myndi því skrifa niður "pass" svo númerin tvö sem lyggja lóðrétt neðst hægramegin. Það ætti að stemma saman.

Ég hafði saltið til gamans en líklega geirir það lítið annað en auka "if statement" fyrir mannin á milli.
Ég ætla þó ekki að taka saltið í burtu og er að spá í að gera það meira "dínamískt"; þ.e.a.s fleirri myndir og svo
"encrypta" þetta fyrir sendingu og decrypta þegar saltið er komið á áfangastaðin með "dínamísku" númerunum tveimum.


Kóðinn fyrir Sha512 "algorithmanum" sem er notaður hér er tekin að láni hjá Jeff Mott og síðan fyrir leyfinu er "code.google.com/p/crypto-js/wiki/License".

VIÐVÖRUN: Kóðin er aðeins byrtur af höfundi, fyrir höfundin sjálan til að læra af og vonandi geta aðrir líka lært og notið góðs af.
Kóðin er ekki vara heldur hugmynd.
Þú mátt leika þér að þessu með mér en þá undir þinni eigin ábyrgð.

WARNING:  The code is only displayed for author learning purposes only.
The code is not a product; it is an idea. 
You can play with this idea with me but no warranty is provided for any pratical use of it. You are responsible.
