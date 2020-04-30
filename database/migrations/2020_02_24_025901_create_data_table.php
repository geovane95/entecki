<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uploaddata');
            $table->unsignedBigInteger('construction');

            $table->foreign('uploaddata')
                ->on('upload_data')
                ->references('id')
                ->onDelete('cascade');

            $table->foreign('construction')
                ->on('constructions')
                ->references('id')
                ->onDelete('cascade');
            $table->string('DATAEMISSAO',32);
            $table->string('CUSTOP',2);
            $table->string('PRAZO',2);
            $table->string('FLUXOD',2);
            $table->string('QUALIDADE',2);
            $table->string('SEGORG',2);
            $table->string('MAMBI',2);
            $table->integer('ACUMCONTR');
            $table->string('FASE',10)->nullable();
            $table->integer('AREACONSTRM2')->nullable();
            $table->integer('NUNITQTD')->nullable();
            $table->string('CORPRRATUAL',10)->nullable();
            $table->string('CORRPRATUALFAROL',2)->nullable();
            $table->double('CORRPRATUALVLR',12,2)->nullable();
            $table->string('FXDPRRATUAL',10)->nullable();
            $table->string('FXDRPRATUALFAROL',2)->nullable();
            $table->double('FXDRPRATUALVLR', 12,2)->nullable();
            $table->string('FPRPRFAROL',2)->nullable();
            $table->double('FPRPR',12,2)->nullable();
            $table->string('POTEROBRARPMESFAROL',2)->nullable();
            $table->string('POTEROBRARPMES',16)->nullable();
            $table->integer('POECOPR')->nullable();
            $table->string('IDQFAROL',2)->nullable();
            $table->string('IDSFAROL',2)->nullable();
            $table->integer('PORCCONTRATINDIC')->nullable();
            $table->double('ACORCPROOJATUAL',10,2)->nullable();
            $table->double('APORCPROOJATUAL',10,2)->nullable();
            $table->double('FBP',6,2)->nullable();
            $table->double('FBR',6,2)->nullable();
            $table->double('FBD',6,2)->nullable();
            $table->double('FOP',6,2)->nullable();
            $table->double('FOR',6,2)->nullable();
            $table->double('FOD',6,2)->nullable();
            $table->double('FOBP',6,2)->nullable();
            $table->double('FOBR',6,2)->nullable();
            $table->double('FOBD',6,2)->nullable();
            $table->double('AREATERRENO',8,2)->nullable();
            $table->double('AREACONSTRUIDA',8,2)->nullable();
            $table->double('AREAPRIVATIVA',8,2)->nullable();
            $table->double('AREAEQUIVNB',8,2)->nullable();
            $table->double('AREADEGARGAGEM',8,2)->nullable();
            $table->double('EFECIEPROJ',8,2)->nullable();
            $table->string('TIPOEMPREEND',40)->nullable();
            $table->string('SISTCONSTRUTIVO',40)->nullable();
            $table->string('NDETORRESPVTOS',40)->nullable();
            $table->string('NPVTOSGARGAGEM',40)->nullable();
            $table->string('NUNIDADES',40)->nullable();
            $table->string('AREAAPARTAMENTOS',40)->nullable();
            $table->string('AGENTEFINANCEIRO',16)->nullable();
            $table->string('DATAVISTORIA',40)->nullable();
            $table->double('VALORFINANCIAMENTO',12,2)->nullable();
            $table->string('ORCCONTRATUAL',40)->nullable();
            $table->double('CUSTORASOOBRA',12,2)->nullable();
            $table->double('TAXAADM',12,2)->nullable();
            $table->double('TAXAADMP',12,2)->nullable();
            $table->double('CUSTORASOTAXA',12,2)->nullable();
            $table->double('MANUTENCAO',12,2)->nullable();
            $table->double('MANUTENCAOP',12,2)->nullable();
            $table->double('CUSTOSDIVERSOS',12,2)->nullable();
            $table->integer('ORCCONTRATUALINCC')->nullable();
            $table->integer('CUSTORASOOBRAINCC')->nullable();
            $table->integer('TAXAADMINCC')->nullable();
            $table->integer('CUSTORASOTAXAINCC')->nullable();
            $table->integer('MANUTENCAOINCC')->nullable();
            $table->integer('CUSTOSDIVERSOSINCC')->nullable();
            $table->string('INICIOPLANOBRAPREV',7)->nullable();
            $table->string('TERMPLANOBRAPREV',7)->nullable();
            $table->string('TERMHABITESEPREV',7)->nullable();
            $table->string('TERMCLIENTEPREV',7)->nullable();
            $table->string('PRAZOBRAMESESPREV',7)->nullable();
            $table->string('INICIOPLANOBRAREAL',7)->nullable();
            $table->string('TERMPLANOBRAREAL',7)->nullable();
            $table->string('TERMHABITESEREAL',7)->nullable();
            $table->string('TERMCLIENTEREAL',7)->nullable();
            $table->string('PRAZOOBRAMESESREAL',7)->nullable();
            $table->integer('INICIOPLANOBRADESV')->nullable();
            $table->integer('TERMPLANOBRADESV')->nullable();
            $table->integer('TERMHABITESEDESV')->nullable();
            $table->integer('TERMCLIENTEDESV')->nullable();
            $table->integer('PRAZOOBRAMESESDESV')->nullable();
            $table->string('INICIOPLANOBRAFAROL',2)->nullable();
            $table->string('TERMPLANOBRAFAROL',2)->nullable();
            $table->string('TERMHABITESEFAROL',2)->nullable();
            $table->string('TERMCLIENTEFAROL',2)->nullable();
            $table->string('PRAZOOBRAMESESFAROL',2)->nullable();
            $table->string('EVOORCID',40)->nullable();
            $table->string('EVOORCINIOBRA',40)->nullable();
            $table->string('EVOORCADTV',40)->nullable();
            $table->string('EVOORCREVOBRA',40)->nullable();
            $table->string('EVOORCIDINCC',40)->nullable();
            $table->string('EVOORCINIOBRAINCC',40)->nullable();
            $table->string('EVOORCADTVINCC',40)->nullable();
            $table->string('EVOORCREVOBRAINCC',40)->nullable();
            $table->string('ACOFACUMTOTAL',40)->nullable();
            $table->string('ACOFSALDOREAL',40)->nullable();
            $table->string('ACOFPROJCUSTO',40)->nullable();
            $table->double('ACOFVARORCREV',12,2)->nullable();
            $table->string('ACOFACUMTOTALINCC',40)->nullable();
            $table->string('ACOFSALDOREALINCC',40)->nullable();
            $table->string('ACOFPROJCUSTOINCC',40)->nullable();
            $table->double('ACOFVARORCREVINCC',12,2)->nullable();
            $table->double('ACOFVARORCREVVALOR',12,2)->nullable();
            $table->string('ACOFVARORCREVFAROL',2)->nullable();
            $table->string('ACOFINCCIN')->nullable();
            $table->string('CUSTOM2PROJCONST',40)->nullable();
            $table->string('CUSTOM2PROJPRIVA',40)->nullable();
            $table->string('CUSTOM2PROJCONSTINCC',40)->nullable();
            $table->string('CUSTOM2PROJPRIVAINCC',40)->nullable();
            $table->string('flameitens')->nullable();
            $table->string('flamevalores')->nullable();
            $table->timestamp('email_sended_at')->nullable();
            $table->string('flamemeses')->nullable();
            $table->string('flameperiodofisprev')->nullable();
            $table->string('flameperiodofisprevmesatual')->nullable();
            $table->string('flameacumulofisreal')->nullable();
            $table->string('flameacumulofisprev')->nullable();
            $table->string('flameacumulofisproj')->nullable();
            $table->string('flameperiodofissubprev')->nullable();
            $table->string('flameperiodofisproj')->nullable();
            $table->string('dfmeses')->nullable();
            $table->string('dfperiodofisprev')->nullable();
            $table->string('dfperiodofisprevmesatual')->nullable();
            $table->string('dfacumulofisreal')->nullable();
            $table->string('dfacumulofisprev')->nullable();
            $table->string('dfacumulofisproj')->nullable();
            $table->string('dfperiodofissubprev')->nullable();
            $table->string('dfperiodofisproj')->nullable();
            $table->integer('aaprevfisobra')->nullable();
            $table->integer('aarealfisobra')->nullable();
            $table->integer('npprevfisobra')->nullable();
            $table->integer('nprealfisobra')->nullable();
            $table->integer('atprevfisobra')->nullable();
            $table->integer('atrealfisobra')->nullable();
            $table->double('dtprevfisobra',12,2)->nullable();
            $table->double('dtrealfisobra',12,2)->nullable();
            $table->string('dtprevfisobrafarol', 2)->nullable();
            $table->string('dtrealfisobrafarol', 2)->nullable();
            $table->integer('aaprevfisbanco')->nullable();
            $table->integer('aarealfisbanco')->nullable();
            $table->integer('npprevfisbanco')->nullable();
            $table->integer('nprealfisbanco')->nullable();
            $table->integer('atprevfisbanco')->nullable();
            $table->integer('atrealfisbanco')->nullable();
            $table->double('dtprevfisbanco',12,2)->nullable();
            $table->double('dtrealfisbanco',12,2)->nullable();
            $table->string('dtprevfisbancofarol',2)->nullable();
            $table->string('dtrealfisbancofarol',2)->nullable();
            $table->integer('aaprevfinbanco')->nullable();
            $table->integer('aarealfinbanco')->nullable();
            $table->integer('npprevfinbanco')->nullable();
            $table->integer('nprealfinbanco')->nullable();
            $table->integer('atprevfinbanco')->nullable();
            $table->integer('atrealfinbanco')->nullable();
            $table->double('dtprevfinbanco',12,2)->nullable();
            $table->double('dtrealfinbanco',12,2)->nullable();
            $table->string('dtprevfinbancofarol', 2)->nullable();
            $table->string('dtrealfinbancofarol', 2)->nullable();
            $table->string('ffomeses')->nullable();
            $table->string('ffodelta')->nullable();
            $table->string('ffoprevrev')->nullable();
            $table->string('fforeal')->nullable();
            $table->string('fdmeses')->nullable();
            $table->string('fddelta')->nullable();
            $table->string('fdprevrev')->nullable();
            $table->string('fdreal')->nullable();
            $table->string('critpremultaconteco')->nullable();
            $table->string('critpremultacontest')->nullable();
            $table->string('prevpremultaconstrs')->nullable();
            $table->string('prevpremultaincorrs')->nullable();
            $table->string('prevpremultaconstincc')->nullable();
            $table->string('prevpremultaincorincc')->nullable();
            $table->text('fatosrelevantes')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE data CHANGE CORRPRATUALVLR CORRPRATUALVLR decimal(12,2) signed');
        DB::statement('ALTER TABLE data CHANGE FXDRPRATUALVLR FXDRPRATUALVLR decimal(12,2) signed');
        DB::statement('ALTER TABLE data CHANGE FPRPR FPRPR decimal(12,2) signed');
        DB::statement('ALTER TABLE data CHANGE ACOFVARORCREV ACOFVARORCREV decimal(12,2) signed');
        DB::statement('ALTER TABLE data CHANGE ACOFVARORCREVINCC ACOFVARORCREVINCC decimal(12,2) signed');
        DB::statement('ALTER TABLE data CHANGE ACOFVARORCREVVALOR ACOFVARORCREVVALOR decimal(12,2) signed');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
