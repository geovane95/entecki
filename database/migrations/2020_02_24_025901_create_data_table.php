<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('CORRPRATUALVLR',18)->nullable();
            $table->string('FXDPRRATUAL',10)->nullable();
            $table->string('FXDRPRATUALFAROL',2)->nullable();
            $table->string('FXDRPRATUALVLR', 18)->nullable();
            $table->string('FPRPRFAROL',2)->nullable();
            $table->string('FPRPR',16)->nullable();
            $table->string('POTEROBRARPMESFAROL',2)->nullable();
            $table->string('POTEROBRARPMES',16)->nullable();
            $table->integer('POECOPR')->nullable();
            $table->string('IDQFAROL',2)->nullable();
            $table->string('IDSFAROL',2)->nullable();
            $table->integer('PORCCONTRATINDIC')->nullable();
            $table->float('ACORCPROOJATUAL',10,2)->nullable();
            $table->float('APORCPROOJATUAL',10,2)->nullable();
            $table->float('FBP',6,2)->nullable();
            $table->float('FBR',6,2)->nullable();
            $table->float('FBD',6,2)->nullable();
            $table->float('FOP',6,2)->nullable();
            $table->float('FOR',6,2)->nullable();
            $table->float('FOD',6,2)->nullable();
            $table->float('FOBP',6,2)->nullable();
            $table->float('FOBR',6,2)->nullable();
            $table->float('FOBD',6,2)->nullable();
            $table->float('AREATERRENO',8,2)->nullable();
            $table->float('AREACONSTRUIDA',8,2)->nullable();
            $table->float('AREAPRIVATIVA',8,2)->nullable();
            $table->float('AREAEQUIVNB',8,2)->nullable();
            $table->float('AREADEGARGAGEM',8,2)->nullable();
            $table->float('EFECIEPROJ',8,2)->nullable();
            $table->string('TIPOEMPREEND',40)->nullable();
            $table->string('SISTCONSTRUTIVO',40)->nullable();
            $table->string('NDETORRESPVTOS',40)->nullable();
            $table->string('NPVTOSGARGAGEM',40)->nullable();
            $table->string('NUNIDADES',40)->nullable();
            $table->string('AREAAPARTAMENTOS',40)->nullable();
            $table->string('AGENTEFINANCEIRO',16)->nullable();
            $table->string('DATAVISTORIA',40)->nullable();
            $table->float('VALORFINANCIAMENTO',12,2)->nullable();
            $table->string('ORCCONTRATUAL',40)->nullable();
            $table->float('CUSTORASOOBRA',12,2)->nullable();
            $table->float('TAXAADM',12,2)->nullable();
            $table->float('CUSTORASOTAXA',12,2)->nullable();
            $table->float('MANUTENCAO',12,2)->nullable();
            $table->float('CUSTOSDIVERSOS',12,2)->nullable();
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
            $table->string('ACOFVARORCREV',40)->nullable();
            $table->string('ACOFACUMTOTALINCC',40)->nullable();
            $table->string('ACOFSALDOREALINCC',40)->nullable();
            $table->string('ACOFPROJCUSTOINCC',40)->nullable();
            $table->string('ACOFVARORCREVINCC',40)->nullable();
            $table->string('ACOFVARORCREVVALOR',30)->nullable();
            $table->string('ACOFVARORCREVFAROL',2)->nullable();
            $table->string('ACOFINCCIN')->nullable();
            $table->string('CUSTOM2PROJCONST',40)->nullable();
            $table->string('CUSTOM2PROJPRIVA',40)->nullable();
            $table->string('CUSTOM2PROJCONSTINCC',40)->nullable();
            $table->string('CUSTOM2PROJPRIVAINCC',40)->nullable();
            $table->integer('PROJEXEC')->nullable();
            $table->integer('FUNDACAOTORRE')->nullable();
            $table->integer('ESTRUTURATORRE')->nullable();
            $table->integer('INSTALACOES')->nullable();
            $table->integer('ACABAMENTO')->nullable();
            $table->integer('REVFACHADA')->nullable();
            $table->integer('AEPAISAGISMO')->nullable();
            $table->timestamp('email_sended_at')->nullable();
            $table->integer('flameperiodofisprev')->nullable();
            $table->float('flameacumulofisreal',12,2)->nullable();
            $table->float('flameacumulofisprev',12,2)->nullable();
            $table->float('flameacumulofisproj',12,2)->nullable();
            $table->float('flameperiodofissubprev',12,2)->nullable();
            $table->integer('flameperiodofisproj')->nullable();
            $table->integer('dfperiodofisprev')->nullable();
            $table->float('dfacumulofisreal',12,2)->nullable();
            $table->float('dfacumulofisprev',12,2)->nullable();
            $table->float('dfacumulofisproj',12,2)->nullable();
            $table->float('dfperiodofissubprev',12,2)->nullable();
            $table->integer('dfperiodofisproj')->nullable();
            $table->integer('aaprevfisobra')->nullable();
            $table->integer('aarealfisobra')->nullable();
            $table->integer('npprevfisobra')->nullable();
            $table->integer('nprealfisobra')->nullable();
            $table->integer('atprevfisobra')->nullable();
            $table->integer('atrealfisobra')->nullable();
            $table->float('dtprevfisobra',12,2)->nullable();
            $table->float('dtrealfisobra',12,2)->nullable();
            $table->string('dtprevfisobrafarol', 2)->nullable();
            $table->string('dtrealfisobrafarol', 2)->nullable();
            $table->integer('aaprevfisbanco')->nullable();
            $table->integer('aarealfisbanco')->nullable();
            $table->integer('npprevfisbanco')->nullable();
            $table->integer('nprealfisbanco')->nullable();
            $table->integer('atprevfisbanco')->nullable();
            $table->integer('atrealfisbanco')->nullable();
            $table->float('dtprevfisbanco',12,2)->nullable();
            $table->float('dtrealfisbanco',12,2)->nullable();
            $table->string('dtprevfisbancofarol',2)->nullable();
            $table->string('dtrealfisbancofarol',2)->nullable();
            $table->integer('aaprevfinbanco')->nullable();
            $table->integer('aarealfinbanco')->nullable();
            $table->integer('npprevfinbanco')->nullable();
            $table->integer('nprealfinbanco')->nullable();
            $table->integer('atprevfinbanco')->nullable();
            $table->integer('atrealfinbanco')->nullable();
            $table->float('dtprevfinbanco',12,2)->nullable();
            $table->float('dtrealfinbanco',12,2)->nullable();
            $table->string('dtprevfinbancofarol', 2)->nullable();
            $table->string('dtrealfinbancofarol', 2)->nullable();
            $table->float('ffodelta',12,2)->nullable();
            $table->float('ffoprevrev',12,2)->nullable();
            $table->float('fforeal',12,2)->nullable();
            $table->float('fddelta',12,2)->nullable();
            $table->float('fdprevrev',12,2)->nullable();
            $table->float('fdreal',12,2)->nullable();
            $table->timestamps();
        });
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
