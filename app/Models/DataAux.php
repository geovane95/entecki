<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 * @method static find($id)
 * @method static where(string $string, string $string1, $id)
 */
class DataAux extends Model
{
    protected $fillable = [
        'uploaddata',
        'construction',
        'DATAEMISSAO',
        'CUSTOP',
        'PRAZO',
        'FLUXOD',
        'QUALIDADE',
        'SEGORG',
        'MAMBI',
        'ACUMCONTR',
        'INCC',
        'NOBRA',
        'FASE',
        'AREACONSTRM2',
        'NUNITQTD',
        'CORPRRATUAL',
        'CORRPRATUALFAROL',
        'CORRPRATUALVLR',
        'FXDPRRATUAL',
        'FXDRPRATUALFAROL',
        'FXDRPRATUALVLR',
        'FPRPRFAROL',
        'FPRPR',
        'POTEROBRARPMESFAROL',
        'POTEROBRARPMES',
        'POECOPR',
        'IDQFAROL',
        'IDSFAROL',
        'PORCCONTRATINDIC',
        'ACORCPROOJATUAL',
        'APORCPROOJATUAL',
        'FBP',
        'FBR',
        'FBD',
        'FOP',
        'FOR',
        'FOD',
        'FOBP',
        'FOBR',
        'FOBD',
        'AREATERRENO',
        'AREACONSTRUIDA',
        'AREAPRIVATIVA',
        'AREAEQUIVNB',
        'AREADEGARGAGEM',
        'EFECIEPROJ',
        'TIPOEMPREEND',
        'SISTCONSTRUTIVO',
        'NDETORRESPVTOS',
        'NPVTOSGARGAGEM',
        'NUNIDADES',
        'AREAAPARTAMENTOS',
        'AGENTEFINANCEIRO',
        'DATAVISTORIA',
        'VALORFINANCIAMENTO',
        'ORCCONTRATUAL',
        'CUSTORASOOBRA',
        'TAXAADM',
        'CUSTORASOTAXA',
        'MANUTENCAO',
        'CUSTOSDIVERSOS',
        'ORCCONTRATUALINCC',
        'CUSTORASOOBRAINCC',
        'TAXAADMINCC',
        'CUSTORASOTAXAINCC',
        'MANUTENCAOINCC',
        'CUSTOSDIVERSOSINCC',
        'INICIOPLANOBRAPREV',
        'TERMPLANOBRAPREV',
        'TERMHABITESEPREV',
        'TERMCLIENTEPREV',
        'PRAZOBRAMESESPREV',
        'INICIOPLANOBRAREAL',
        'TERMPLANOBRAREAL',
        'TERMHABITESEREAL',
        'TERMCLIENTEREAL',
        'PRAZOOBRAMESESREAL',
        'INICIOPLANOBRADESV',
        'TERMPLANOBRADESV',
        'TERMHABITESEDESV',
        'TERMCLIENTEDESV',
        'PRAZOOBRAMESESDESV',
        'INICIOPLANOBRAFAROL',
        'TERMPLANOBRAFAROL',
        'TERMHABITESEFAROL',
        'TERMCLIENTEFAROL',
        'PRAZOOBRAMESESFAROL',
        'EVOORCID',
        'EVOORCINIOBRA',
        'EVOORCADTV',
        'EVOORCREVOBRA',
        'EVOORCIDINCC',
        'EVOORCINIOBRAINCC',
        'EVOORCADTVINCC',
        'EVOORCREVOBRAINCC',
        'ACOFACUMTOTAL',
        'ACOFSALDOREAL',
        'ACOFPROJCUSTO',
        'ACOFVARORCREV',
        'ACOFACUMTOTALINCC',
        'ACOFSALDOREALINCC',
        'ACOFPROJCUSTOINCC',
        'ACOFVARORCREVINCC',
        'ACOFVARORCREVVALOR',
        'ACOFVARORCREVFAROL',
        'ACOFINCCIN',
        'CUSTOM2PROJCONST',
        'CUSTOM2PROJPRIVA',
        'CUSTOM2PROJCONSTINCC',
        'CUSTOM2PROJPRIVAINCC',
        'PROJEXEC',
        'FUNDACAOTORRE',
        'ESTRUTURATORRE',
        'INSTALACOES',
        'ACABAMENTO',
        'REVFACHADA',
        'AEPAISAGISMO',
        'flamemeses',
        'flameperiodofisprev',
        'flameperiodofisprevmesatual',
        'flameacumulofisreal',
        'flameacumulofisprev',
        'flameacumulofisproj',
        'flameperiodofissubprev',
        'flameperiodofisproj',
        'dfmeses',
        'dfperiodofisprev',
        'dfperiodofisprevmesatual',
        'dfacumulofisreal',
        'dfacumulofisprev',
        'dfacumulofisproj',
        'dfperiodofissubprev',
        'dfperiodofisproj',
        'aaprevfisobra',
        'aarealfisobra',
        'npprevfisobra',
        'nprealfisobra',
        'atprevfisobra',
        'atrealfisobra',
        'dtprevfisobra',
        'dtrealfisobra',
        'dtprevfisobrafarol',
        'dtrealfisobrafarol',
        'aaprevfisbanco',
        'aarealfisbanco',
        'npprevfisbanco',
        'nprealfisbanco',
        'atprevfisbanco',
        'atrealfisbanco',
        'dtprevfisbanco',
        'dtrealfisbanco',
        'dtprevfisbancofarol',
        'dtrealfisbancofarol',
        'aaprevfinbanco',
        'aarealfinbanco',
        'npprevfinbanco',
        'nprealfinbanco',
        'atprevfinbanco',
        'atrealfinbanco',
        'dtprevfinbanco',
        'dtrealfinbanco',
        'dtprevfinbancofarol',
        'dtrealfinbancofarol',
        'ffomeses',
        'ffodelta',
        'ffoprevrev',
        'fforeal',
        'fdmeses',
        'fddelta',
        'fdprevrev',
        'fdreal',
        'critpremultaconteco',
        'critpremultacontest',
        'prevpremultaconstrs',
        'prevpremultaincorrs',
        'prevpremultaconstincc',
        'prevpremultaincorincc',
        'datasmarco',
        'adiccritpremulta',
        'email_sended_at'
        ];
}
