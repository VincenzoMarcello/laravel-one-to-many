# TRACCIA

Continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo e aggiungiamo una nuova entità **Type**. Questa entità rappresenta la tipologia di progetto ed è in relazione one to many con i progetti.
I task da svolgere sono diversi, ma alcuni di essi sono un ripasso di ciò che abbiamo fatto nelle lezioni dei giorni scorsi:

-   creare la migration per la tabella types
-   creare il model Type
-   creare la migration di modifica per la tabella projects per aggiungere la chiave esterna
-   aggiungere ai model Type e Project i metodi per definire la relazione one to many
-   visualizzare nella pagina di dettaglio di un progetto la tipologia associata, se presente
-   permettere all'utente di associare una tipologia nella pagina di creazione e modifica di un progetto
-   gestire il salvataggio dell'associazione progetto-tipologia con opportune regole di validazione
    Bonus 1:
    creare il seeder per il model Type.
    Bonus 2:
    aggiungere le operazioni CRUD per il model Type, in modo da gestire le tipologie di progetto direttamente dal pannello di amministrazione.

# SVOLGIMENTO

-   Innazitutto ci dobbiamo creare la nuova tabella _types_ quindi il model e la migration e il seeder per popolarla:

```
php artisan make:model Type -ms

Così in un colpo solo ci creiamo model,migration e seeder
```

-   poi andiamo in migrations\create_types_table.php e ci creiamo le colonne della tabella:

```php
  public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('label', 20);
            // QUI METTIAMO 7 PERCHE' USIAMO L'ESADECIMALE PER IL COLORE
            $table->char('color', 7);
            $table->timestamps();
        });
    }
```

-   buttiamo giù le tabelle con:

```
php artisan make:reset
```

-   perchè dobbiamo aggiungere la chiave secondaria per fare il collegamento quindi ci creiamo una nuova migration:

```
php artisan make:migration add_foreign_type_id_to_projects_table
```

-   andiamo nella migration appena creata e ci creiamo colonna e relazione:

```php
 public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('type_id')->constrained();  <----
        });
    }

    foreignId('type_id') colonna
    constrained() relazione
```

-   possiamo arricchire questa funzione aggiungendo:

```php
 $table->foreignId('type_id')->nullable()->after('id')->constrained()->nullOnDelete();

 nullable() qui stiamo dicendo che un progetto potrebbe anche non avere un tipo
 after('id') qui stiamo dicendo che la colonna "type_id" sarà piazzata dopo la colonna "id"
 nullOnDelete() qui stiamo dicendo se il tipo viene cancellato metti null al progetto
 questa va in combo con nullable()
```

-   Ora nel metodo down dobbiamo droppare la relazione e la colonna in maniera tale che se facciamo un reset o un refresh non darà errore:

```php
 public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // # DROP RELAZIONE
            $table->dropForeign('projects_type_id_foreign');
            // # DROP COLONNA
            $table->dropColumn('type_id');
        });
    }

    RICORDA: Se non droppi prima la relazione non riuscirai a droppare la colonna
```

-   facciamo un migrate per aggiungere la relazione e la colonna:

```
php artisan migrate
```

-   possiamo provare a fare un reset o un refresh per vedere se funziona tutto senza errori
