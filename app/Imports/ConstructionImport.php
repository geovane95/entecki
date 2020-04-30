<?php

namespace App\Imports;

use App\Models\Construction;
use App\Models\Data;
use App\Models\DataAux;
use App\Models\User;
use http\Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ConstructionImport implements ToCollection, WithHeadingRow
{
    private $competence, $upload_data;

    public function __construct($competence, $upload_data)
    {
        $this->competence = $competence;
        $this->upload_data = $upload_data;
    }

    public function collection(Collection $rows)
    {
        $aprov = false;

        if (auth()->user()->access_profile == 1) {
            $aprov = true;
        }
        $contador = 0;
        foreach ($rows as $row) {
            $construction = Construction::find($row['obra_id']);
            if ($construction) {
                $data = [
                    'construction' => $row['obra_id'],
                    'uploaddata' => $this->upload_data->id,
                    'DATAEMISSAO' => $row['dataemissao'],
                    'CUSTOP' => $row['custop'],
                    'PRAZO' => $row['prazo'],
                    'FLUXOD' => $row['fluxod'],
                    'QUALIDADE' => $row['qualidade'],
                    'SEGORG' => $row['segorg'],
                    'MAMBI' => $row['mambi'],
                    'ACUMCONTR' => $row['acumcontr'],
                    'FASE' => $row['fase'],
                    'AREACONSTRM2' => $row['areaconstrm2'],
                    'NUNITQTD' => $row['nunitqtd'],
                    'CORPRRATUAL' => $row['corprratual'],
                    'CORRPRATUALFAROL' => $row['corrpratualfarol'],
                    'CORRPRATUALVLR' => $row['corrpratualvlr'],
                    'FXDPRRATUAL' => $row['fxdprratual'],
                    'FXDRPRATUALFAROL' => $row['fxdrpratualfarol'],
                    'FXDRPRATUALVLR' => $row['fxdrpratualvlr'],
                    'FPRPRFAROL' => $row['fprprfarol'],
                    'FPRPR' => $row['fprpr'],
                    'POTEROBRARPMESFAROL' => $row['poterobrarpmesfarol'],
                    'POTEROBRARPMES' => $row['poterobrarpmes'],
                    'POECOPR' => $row['poecopr'],
                    'IDQFAROL' => $row['idqfarol'],
                    'IDSFAROL' => $row['idsfarol'],
                    'PORCCONTRATINDIC' => $row['porccontratindic'],
                    'ACORCPROOJATUAL' => $row['acorcproojatual'],
                    'APORCPROOJATUAL' => $row['aporcproojatual'],
                    'FBP' => $row['fbp'],
                    'FBR' => $row['fbr'],
                    'FBD' => $row['fbd'],
                    'FOP' => $row['fop'],
                    'FOR' => $row['for'],
                    'FOD' => $row['fod'],
                    'FOBP' => $row['fobp'],
                    'FOBR' => $row['fobr'],
                    'FOBD' => $row['fobd'],
                    'AREATERRENO' => $row['areaterreno'],
                    'AREACONSTRUIDA' => $row['areaconstruida'],
                    'AREAPRIVATIVA' => $row['areaprivativa'],
                    'AREAEQUIVNB' => $row['areaequivnb'],
                    'AREADEGARGAGEM' => $row['areadegargagem'],
                    'EFECIEPROJ' => $row['efecieproj'],
                    'TIPOEMPREEND' => $row['tipoempreend'],
                    'SISTCONSTRUTIVO' => $row['sistconstrutivo'],
                    'NDETORRESPVTOS' => $row['ndetorrespvtos'],
                    'NPVTOSGARGAGEM' => $row['npvtosgargagem'],
                    'NUNIDADES' => $row['nunidades'],
                    'AREAAPARTAMENTOS' => $row['areaapartamentos'],
                    'AGENTEFINANCEIRO' => $row['agentefinanceiro'],
                    'DATAVISTORIA' => $row['datavistoria'],
                    'VALORFINANCIAMENTO' => $row['valorfinanciamento'],
                    'ORCCONTRATUAL' => $row['orccontratual'],
                    'CUSTORASOOBRA' => $row['custorasoobra'],
                    'TAXAADM' => $row['taxaadm'],
                    'TAXAADMP' => $row['taxaadmp'],
                    'CUSTORASOTAXA' => $row['custorasotaxa'],
                    'MANUTENCAO' => $row['manutencao'],
                    'MANUTENCAOP' => $row['manutencaop'],
                    'CUSTOSDIVERSOS' => $row['custosdiversos'],
                    'ORCCONTRATUALINCC' => $row['orccontratualincc'],
                    'CUSTORASOOBRAINCC' => $row['custorasoobraincc'],
                    'TAXAADMINCC' => $row['taxaadmincc'],
                    'CUSTORASOTAXAINCC' => $row['custorasotaxaincc'],
                    'MANUTENCAOINCC' => $row['manutencaoincc'],
                    'CUSTOSDIVERSOSINCC' => $row['custosdiversosincc'],
                    'INICIOPLANOBRAPREV' => $row['inicioplanobraprev'],
                    'TERMPLANOBRAPREV' => $row['termplanobraprev'],
                    'TERMHABITESEPREV' => $row['termhabiteseprev'],
                    'TERMCLIENTEPREV' => $row['termclienteprev'],
                    'PRAZOBRAMESESPREV' => $row['prazobramesesprev'],
                    'INICIOPLANOBRAREAL' => $row['inicioplanobrareal'],
                    'TERMPLANOBRAREAL' => $row['termplanobrareal'],
                    'TERMHABITESEREAL' => $row['termhabitesereal'],
                    'TERMCLIENTEREAL' => $row['termclientereal'],
                    'PRAZOOBRAMESESREAL' => $row['prazoobramesesreal'],
                    'INICIOPLANOBRADESV' => $row['inicioplanobradesv'],
                    'TERMPLANOBRADESV' => $row['termplanobradesv'],
                    'TERMHABITESEDESV' => $row['termhabitesedesv'],
                    'TERMCLIENTEDESV' => $row['termclientedesv'],
                    'PRAZOOBRAMESESDESV' => $row['prazoobramesesdesv'],
                    'INICIOPLANOBRAFAROL' => $row['inicioplanobrafarol'],
                    'TERMPLANOBRAFAROL' => $row['termplanobrafarol'],
                    'TERMHABITESEFAROL' => $row['termhabitesefarol'],
                    'TERMCLIENTEFAROL' => $row['termclientefarol'],
                    'PRAZOOBRAMESESFAROL' => $row['prazoobramesesfarol'],
                    'EVOORCID' => $row['evoorcid'],
                    'EVOORCINIOBRA' => $row['evoorciniobra'],
                    'EVOORCADTV' => $row['evoorcadtv'],
                    'EVOORCREVOBRA' => $row['evoorcrevobra'],
                    'EVOORCIDINCC' => $row['evoorcidincc'],
                    'EVOORCINIOBRAINCC' => $row['evoorciniobraincc'],
                    'EVOORCADTVINCC' => $row['evoorcadtvincc'],
                    'EVOORCREVOBRAINCC' => $row['evoorcrevobraincc'],
                    'ACOFACUMTOTAL' => $row['acofacumtotal'],
                    'ACOFSALDOREAL' => $row['acofsaldoreal'],
                    'ACOFPROJCUSTO' => $row['acofprojcusto'],
                    'ACOFVARORCREV' => $row['acofvarorcrev'],
                    'ACOFACUMTOTALINCC' => $row['acofacumtotalincc'],
                    'ACOFSALDOREALINCC' => $row['acofsaldorealincc'],
                    'ACOFPROJCUSTOINCC' => $row['acofprojcustoincc'],
                    'ACOFVARORCREVINCC' => $row['acofvarorcrevincc'],
                    'ACOFVARORCREVVALOR' => $row['acofvarorcrevvalor'],
                    'ACOFVARORCREVFAROL' => $row['acofvarorcrevfarol'],
                    'ACOFINCCIN' => $row['acofinccin'],
                    'CUSTOM2PROJCONST' => $row['custom2projconst'],
                    'CUSTOM2PROJPRIVA' => $row['custom2projpriva'],
                    'CUSTOM2PROJCONSTINCC' => $row['custom2projconstincc'],
                    'CUSTOM2PROJPRIVAINCC' => $row['custom2projprivaincc'],
                    'flameitens' => $row['flameitens'],
                    'flamevalores' => $row['flamevalores'],
                    'flamemeses' => $row['flamemeses'],
                    'flameperiodofisprev' => $row['flameperiodofisprev'],
                    'flameperiodofisprevmesatual' => $row['flameperiodofisprevmesatual'],
                    'flameacumulofisreal' => $row['flameacumulofisreal'],
                    'flameacumulofisprev' => $row['flameacumulofisprev'],
                    'flameacumulofisproj' => $row['flameacumulofisproj'],
                    'flameperiodofissubprev' => $row['flameperiodofissubprev'],
                    'flameperiodofisproj' => $row['flameperiodofisproj'],
                    'dfmeses' => $row['dfmeses'],
                    'dfperiodofisprev' => $row['dfperiodofisprev'],
                    'dfperiodofisprevmesatual' => $row['dfperiodofisprevmesatual'],
                    'dfacumulofisreal' => $row['dfacumulofisreal'],
                    'dfacumulofisprev' => $row['dfacumulofisprev'],
                    'dfacumulofisproj' => $row['dfacumulofisproj'],
                    'dfperiodofissubprev' => $row['dfperiodofissubprev'],
                    'dfperiodofisproj' => $row['dfperiodofisproj'],
                    'aaprevfisobra' => $row['aaprevfisobra'],
                    'aarealfisobra' => $row['aarealfisobra'],
                    'npprevfisobra' => $row['npprevfisobra'],
                    'nprealfisobra' => $row['nprealfisobra'],
                    'atprevfisobra' => $row['atprevfisobra'],
                    'atrealfisobra' => $row['atrealfisobra'],
                    'dtprevfisobra' => $row['dtprevfisobra'],
                    'dtrealfisobra' => $row['dtrealfisobra'],
                    'dtprevfisobrafarol' => $row['dtprevfisobrafarol'],
                    'dtrealfisobrafarol' => $row['dtrealfisobrafarol'],
                    'aaprevfisbanco' => $row['aaprevfisbanco'],
                    'aarealfisbanco' => $row['aarealfisbanco'],
                    'npprevfisbanco' => $row['npprevfisbanco'],
                    'nprealfisbanco' => $row['nprealfisbanco'],
                    'atprevfisbanco' => $row['atprevfisbanco'],
                    'atrealfisbanco' => $row['atrealfisbanco'],
                    'dtprevfisbanco' => $row['dtprevfisbanco'],
                    'dtrealfisbanco' => $row['dtrealfisbanco'],
                    'dtprevfisbancofarol' => $row['dtprevfisbancofarol'],
                    'dtrealfisbancofarol' => $row['dtrealfisbancofarol'],
                    'aaprevfinbanco' => $row['aaprevfinbanco'],
                    'aarealfinbanco' => $row['aarealfinbanco'],
                    'npprevfinbanco' => $row['npprevfinbanco'],
                    'nprealfinbanco' => $row['nprealfinbanco'],
                    'atprevfinbanco' => $row['atprevfinbanco'],
                    'atrealfinbanco' => $row['atrealfinbanco'],
                    'dtprevfinbanco' => $row['dtprevfinbanco'],
                    'dtrealfinbanco' => $row['dtrealfinbanco'],
                    'dtprevfinbancofarol' => $row['dtprevfinbancofarol'],
                    'dtrealfinbancofarol' => $row['dtrealfinbancofarol'],
                    'ffomeses' => $row['ffomeses'],
                    'ffodelta' => $row['ffodelta'],
                    'ffoprevrev' => $row['ffoprevrev'],
                    'fforeal' => $row['fforeal'],
                    'fdmeses' => $row['fdmeses'],
                    'fddelta' => $row['fddelta'],
                    'fdprevrev' => $row['fdprevrev'],
                    'fdreal' => $row['fdreal'],
                    'critpremultaconteco' => $row['critpremultaconteco'],
                    'critpremultacontest' => $row['critpremultacontest'],
                    'prevpremultaconstrs' => $row['prevpremultaconstrs'],
                    'prevpremultaincorrs' => $row['prevpremultaincorrs'],
                    'prevpremultaconstincc' => $row['prevpremultaconstincc'],
                    'prevpremultaincorincc' => $row['prevpremultaincorincc'],
                    'fatosrelevantes' => $row['fatosrelevantes']
                ];
                try {
                    if ($aprov) {
                        Data::create($data);
                        $contador++;
                    } else {
                        DataAux::create($data);
                    }
                } catch (Exception $e) {
                    $this->upload_data->uploadstatus = 3;
                    $this->upload_data->update();
                }
            }
        }

        if ($aprov) {
            $this->upload_data->uploadstatus = 2;
            $this->upload_data->linecount = $contador;
        } else {
            $this->upload_data->uploadstatus = 4;
        }
        $this->upload_data->update();
    }

    public function headingRow(): int
    {
        return 2;
    }
}
