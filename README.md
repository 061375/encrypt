# Reversable Password Encryption

Password encryption to be stored in the database. 

I built a simple local Wiki for my home server that contained passwords.

I wanted to encrypt the passwords in the database, and I needed to retreive the passwords as readable text.

So using something like an MD5 was out of the question.

Its true that in my local machine...its UNLIKELY that anyone will get into the database. And lets face it...The database isn't stored remotely, and if anyone got into my machine they would, with a little hunting around, be able to find the code and then extract the passwords from the database.

But, like many projects...it sounded fun.

So I built my own cypher.

And this is it.

