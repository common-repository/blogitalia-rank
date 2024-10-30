=== BlogItalia Rank ===
Contributors: pixel8383
Tags: statistics, stats, rank, blogitalia, antipixel
Donate link: http://www.dreamsworld.it/emanuele/la-mia-wishlist/
Requires at least: 1.5
Tested up to: 2.9
Stable tag: 1.1

Questo plugin permette di aggiungere il rank di BlogItalia sul proprio blog.

== Description ==

Questo plugin permette di aggiungere il rank di BlogItalia sul proprio blog.

== Installation ==

Se hai gia' installato un plugin, allora installare questo sara' facilissimo.

1. Estrai il file. Copia il file `blogitaliarank.php` nella cartella `/wp-content/plugins/`
2. Attiva il plugin attraverso il menu 'Plugins' di Wordpress
3. Inserisci nel template la seguente stringa: `<?php if(function_exists(wp_blogitaliarank)) { wp_blogitaliarank("ID"); } ?>`
4. Sostituisci in "ID" il numero assegnato da BlogItalia nell'url verso il tuo blog.
	Per trovarlo, vai su `http://www.blogitalia.it/i_tuoi_blog.asp` dopo aver effettuato il login e posiziona il mouse sul titolo del blog di tuo interesse.
	L'url indicato avra' una forma tipo: `http://www.blogitalia.it/leggi_blog.asp?id=XXXX` --> i quattro numeri finali sono il tuo ID.

Ad esempio: `<?php if(function_exists(wp_blogitaliarank)) { wp_blogitaliarank("7596"); } ?>`

**Hai finito**. Goditi il tuo rank visualizzato sul tuo blog. :-)

---

Se invece del banner vuoi usare la *forma testuale*, esegui le istruzioni qui di seguito:

1. Inserisci nel template del blog il seguente codice: `<?php wp_blogitaliarank_text("ID"); ?>`
2. Sostituisci in "ID" il numero assegnato da BlogItalia nell'url verso il tuo blog (segui il punto 4 descritto sopra).

Ad esempio: `<?php wp_blogitaliarank_text("7596"); ?>`

Il risultato sara' un numero con un link verso la pagina del tuo rank su BlogItalia.

----

Tramite CSS e' possibile personalizzare graficamente il testo, usando le seguenti classi: "blogitalia-green" e "blogitalia-red".

Ad esempio, per visualizzare il risultato verde o rosso in base all'incremento o decremento di posizioni su BlogItalia, bastera' aggiungere il seguente codice al foglio di stile:

*.blogitalia-green { color: #00FF00; }*
*.blogitalia-red { color: #ff0000; }*
---

== Frequently Asked Questions ==

= Wordpress mi segnala una nuova versione, come aggiorno il plugin? =

Semplicemente scarica la nuova versione e sostituisci il file `blogitaliarank.php` della cartella `wp-content/plugins/` con quello nuovo.

= L'immagine non si vede, da cosa puo' dipendere? =

Assicurati che l'immagine `bir.png` sia presente nella cartella `wp-content/uploads/` della tua installazione di Wordpress.
Se cosi' non fosse, assicurati di dare sufficienti permessi in scrittura per quella cartella. Un `chmode 644` dovrebbe bastare.

= Ogni quanto si aggiorna l'immagine? =

L'immagine si aggiornera' ogni 18 ore circa (ma comunque massimo una volta al giorno). Se vuoi forzare l'aggiornamento dell'immagine, ti basta cancellare il file `bir.png` presente nella cartella `wp-content/uploads/` della tua installazione di Wordpress.

= Il plugin salva dei dati sul database di Wordpress? =

Uno dei punti di forza di `BlogItalia Rank` e' la sua estrema leggerezza che fa si che non abbia alcun bisogno del database. Questo permette una maggiore velocita' in caricamento ed un minore appesantimento del lavoro per il tuo server.

= Come disinstallo il plugin? =
Se proprio non ti piace il plugin e vuoi disinstallarlo ed eliminare ogni sua traccia, esegui queste semplici operazioni:

1. Disattiva il plugin `BlogItalia Rank` attraverso il menu 'Plugins' di Wordpress
2. Elimina il codice PHP inserito nel template.
3. Elimina il file `bir.png` presente nella cartella `wp-content/uploads/` della tua installazione di Wordpress.
4. Elimina il file `blogitaliarank.php` presente nella cartella `/wp-content/plugins/`.

== Credits ==

Per rispetto del mio lavoro, ti sarei grato se i credits rimanessero intatti ;-)

Emanuele (aka P|xeL)

http://www.dreamsworld.it/emanuele/