# TranslateWebApp

**The idea of this project is to let the users define their own dictionary and then use it to translate English texts in input.**

**Built a web page that:**

* Ensures a secure Session mechanism.
* Allows the user to submit a file (dictionary file) that contains English words of your choice and the direct translation in Latin. (Where the uploaded file has english word commma seperated with Latin word)
* Lets sign up and authenticate a User, allowing him/her/it to submit and then retrieve the model (that is, the translation of each individual word)
* Lets input a text in a text box and apply a direct translation to it. Note: If the user didn't upload any file yet, it should translate with a build in translation model (aka, default translation).

**Built a web application that:**

* Reads the file in input, interprets it and sends to the database the translation model.
* Reads the input from the text input and applies the translation based on the model.
* The "default model" is used in case the User didn't sign up, or if it's logged in, but didn't upload any translation model.
* If the User is logged in and has uploaded a translation model, this model is applied by the web application.

**Built a MySQL database that:**

* Stores the information regarding the translation model per each user.
* Stores the information related to each user account with username and password, in a secure way.
