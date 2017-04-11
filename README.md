# Reversable Password Encryption

Password encryption to be stored in the database. 

I would suggest against using this on a real project...It was just for fun.

I built a simple local Wiki for my home server that contained passwords.

I wanted to encrypt the passwords in the database, and I needed to retreive the passwords as readable text.

So using something like an MD5 was out of the question. ( that's a secure hash and not encryption )

Its true that in my local machine...its UNLIKELY that anyone will get into the database. And lets face it...The database isn't stored remotely, and if anyone got into my machine they would, with a little hunting around, be able to find the code and then extract the passwords from the database.

But, like many projects...it sounded fun.

So I built my own cypher.

And this is it.

A cool feature is that is contians its own salt.
The salt is mixed in to the first encryption level based on a random length and location.
Information about the salt to return its value is located at a specific location in the encryptd string.

______________________



This is what the sample output might look like running the run.php ( test code ) from the command-line

```
# php run.php 'Voltron is a robot and Bugatti is a super car'


Begin Encryption Algorithm


____________________________________________________



password =  Voltron is a robot and Bugatti is a super car

This is the encrypted data uncompressed:
1ABA1A401A7B1BB11A4B119B1ABA11501ABA1BBA1ABA1B111ABB1A011A0A1BBA1AB011511B1011501A4A1BBA1BB011511A7A1B0A1B001B1B1AB0119B1BB01B1A1AAB1A0B1A4A119B1A511B011B0B1A911ABB1B0A1A1A1A811A711A9B1A0A11611AAB1B011A801A4B1A7A115A1BB011501A7B1B0111711BA11A111A0B1B001BBA1A111A0B1A011A8B1A7B1B0111711A911A7A115B1AB11A8B1A511A4B11611A9B1A111A011A1A11511A5A115A1A0A11501A801A0B1A9B1A8B1A711A501AA11A8B1A511ABB119A1BBA1A801A50119A1B001A7B1A91119A1A9A1A511A501A1A1BAA1A511A4B1BA01A811AAB115B1A4A1A011ABA1A9A1BB01A7A1A111BBA1BA01B001A5A11511B101BAA1ABB1ABB1BAB11BB1A4A1A011BAB1A901A501A401A801A501A801A411A801BB11A501B011A4A1B1A1AB01A011BA01B1A1A1B1AB111811181


This is the ecrypted data after compression:

x?UR[??Hck>????tUi1`L???????I??;??g??!?{???q?aT?.???????F3Ɵ?=??f?Q??2Wp?|\???.??"?|???+ĝ???????8???!?|?m?t?^??????V???P|???-???'/?2????'???'????Ƀvs??????>$Z?S??qԃ????K???O?8_j?<??C????,O?n??~*<????p??;?e^Zo??R



password decrypted =  Voltron is a robot and Bugatti is a super car

____________________________________________________
```
