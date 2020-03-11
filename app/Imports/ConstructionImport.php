<?php

namespace App\Imports;

use App\Models\Data;
use http\Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ConstructionImport implements ToCollection
{
    private $competence, $upload_data;
    public function __construct($competence, $upload_data)
    {
        $this->competence = $competence;
        $this->upload_data = $upload_data;
    }

    public function collection(Collection $rows)
    {
        $contador = 0;
        foreach ($rows as $row) {
            try {
                Data::create([
                    'construction' => $row[0],
                    'uploaddata' => $this->upload_data->id,
                    'CUSTOP' => $row[1],
                    'PRAZO' => $row[2],
                    'FLUXOD' => $row[3],
                    'QUALIDADE' => $row[4],
                    'SEGORG' => $row[5],
                    'MAMBI' => $row[6],
                    'ACUMCONTR' => $row[7],
                    'FASE'=>$row[8],
                    'AREACONSTRM2' => $row[9],
                    'NUNITQTD' => $row[10],
                    'CORPRRATUAL' => $row[11],
                    'CORRPRATUALFAROL' => $row[12],
                    'CORRPRATUALVLR' => $row[13],
                    'FXDPRRATUAL' => $row[14],
                    'FXDRPRATUALFAROL' => $row[15],
                    'FXDRPRATUALVLR' => $row[16],
                    'FPRPRFAROL' => $row[17],
                    'FPRPR' => $row[18],
                    'POTEROBRARPMESFAROL' => $row[19],
                    'POTEROBRARPMES' => $row[20],
                    'POECOPR' => $row[21],
                    'IDQFAROL' => $row[22],
                    'IDSFAROL' => $row[23],
                    'PORCCONTRATINDIC' => $row[24],
                    'ACORCPROOJATUAL' => $row[25],
                    'APORCPROOJATUAL' => $row[26],
                     'FBP' => $row[27],
                     'FBR' => $row[28],
                     'FBD' => $row[29],
                     'FOP' => $row[30],
                     'FOR' => $row[31],
                     'FOD' => $row[32],
                     'FOBP' => $row[33],
                     'FOBR' => $row[34],
                     'FOBD' => $row[35],
                     'AREATERRENO' => $row[36],
                     'AREACONSTRUIDA' => $row[37],
                     'AREAPRIVATIVA' => $row[38],
                     'AREAEQUIVNB' => $row[39],
                     'AREADEGARGAGEM' => $row[40],
                     'EFECIEPROJ' => $row[41],
                     'TIPOEMPREEND' => $row[42],
                     'SISTCONSTRUTIVO' => $row[43],
                     'NDETORRESPVTOS' => $row[44],
                     'NPVTOSGARGAGEM' => $row[45],
                     'NUNIDADES' => $row[46],
                     'AREAAPARTAMENTOS' => $row[47],
                     'AGENTEFINANCEIRO' => $row[48],
                     'DATAVISTORIA' => $row[49],
                     'VALORFINANCIAMENTO' => $row[50],
                     'ORCCONTRATUAL' => $row[51],
                     'CUSTORASOOBRA' => $row[52],
                     'TAXAADM' => $row[53],
                     'CUSTORASOTAXA' => $row[54],
                     'MANUTENCAO' => $row[55],
                     'CUSTOSDIVERSOS' => $row[56],
                     'ORCCONTRATUALINCC' => $row[57],
                     'CUSTORASOOBRAINCC' => $row[58],
                     'TAXAADMINCC' => $row[59],
                     'CUSTORASOTAXAINCC' => $row[60],
                     'MANUTENCAOINCC' => $row[61],
                     'CUSTOSDIVERSOSINCC' => $row[62],
                     'INICIOPLANOBRAPREV' => $row[63],
                     'TERMPLANOBRAPREV' => $row[64],
                     'TERMHABITESEPREV' => $row[65],
                     'TERMCLIENTEPREV' => $row[66],
                     'PRAZOBRAMESESPREV' => $row[67],
                     'INICIOPLANOBRAREAL' => $row[68],
                     'TERMPLANOBRAREAL' => $row[69],
                     'TERMHABITESEREAL' => $row[70],
                     'TERMCLIENTEREAL' => $row[71],
                     'PRAZOOBRAMESESREAL' => $row[72],
                     'INICIOPLANOBRADESV' => $row[73],
                     'TERMPLANOBRADESV' => $row[74],
                     'TERMHABITESEDESV' => $row[75],
                     'TERMCLIENTEDESV' => $row[76],
                     'PRAZOOBRAMESESDESV' => $row[77],
                     'INICIOPLANOBRAFAROL' => $row[78],
                     'TERMPLANOBRAFAROL' => $row[79],
                     'TERMHABITESEFAROL' => $row[80],
                     'TERMCLIENTEFAROL' => $row[81],
                     'PRAZOOBRAMESESFAROL' => $row[82],
                     'EVOORCID' => $row[83],
                     'EVOORCINIOBRA' => $row[84],
                     'EVOORCADTV' => $row[85],
                     'EVOORCREVOBRA' => $row[86],
                     'EVOORCIDINCC' => $row[87],
                     'EVOORCINIOBRAINCC' => $row[88],
                     'EVOORCADTVINCC' => $row[89],
                     'EVOORCREVOBRAINCC' => $row[90],
                     'ACOFACUMTOTAL' => $row[91],
                     'ACOFSALDOREAL' => $row[92],
                     'ACOFPROJCUSTO' => $row[93],
                     'ACOFVARORCREV' => $row[94],
                     'ACOFACUMTOTALINCC' => $row[95],
                     'ACOFSALDOREALINCC' => $row[96],
                     'ACOFPROJCUSTOINCC' => $row[97],
                     'ACOFVARORCREVINCC' => $row[98],
                     'ACOFVARORCREVVALOR' => $row[99],
                     'ACOFVARORCREVFAROL' => $row[100],
                     'ACOFINCCIN' => $row[101],
                     'CUSTOM2PROJCONST' => $row[102],
                     'CUSTOM2PROJPRIVA' => $row[103],
                     'CUSTOM2PROJCONSTINCC' => $row[104],
                     'CUSTOM2PROJPRIVAINCC' => $row[105],
                     'PROJEXEC' => $row[106],
                     'FUNDACAOTORRE' => $row[107],
                     'ESTRUTURATORRE' => $row[108],
                     'INSTALACOES' => $row[109],
                     'ACABAMENTO' => $row[110],
                     'REVFACHADA' => $row[111],
                     'AEPAISAGISMO' => $row[112]
                ]);
                $contador++;
            }catch(Exception $e){
                $this->upload_data->uploadstatus = 3;
                $this->upload_data->update();
            }
        }
        $this->upload_data->uploadstatus = 2;
        $this->upload_data->linecount = $contador;
        $this->upload_data->update();
    }
}
