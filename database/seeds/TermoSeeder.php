<?php

use Illuminate\Database\Seeder;

class TermoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Termo::create([
            'nome' => 'covid',
            'desc' => 'Pelo presente instrumento particular, XXXXXXXXX e XXXXXXXXXX, casados entre si em regime de comunhão parcial de bens, resolvem celebrar o presente termo de compromisso de acordo com as cláusulas e condições a seguir  determinadas:

 

            Cláusula Primeira: Do objeto:
            
             
            
            O objeto do presente termo de compromisso é a celebração do contrato de compra e venda de bem imóvel rural de propriedade do casal inscrito no NIRF sob o n. XXXXXXX, situado na cidade de Brumadinho/MG no local denominado Córrego da Alma, com área total de XXXX.
            
             
            
            Cláusula Segunda: Do preço:
            
             
            
            O valor integral recebido pelo casal com a venda do imóvel referido na cláusula anterior será depositado em uma conta poupança, que só poderá ser movimentada pelo casal conjuntamente.
            
             
            
            Cláusula Terceira: Das obrigações:
            
             
            
            O  cônjuge virago se compromete a firmar instrumento público de procuração em favor do cônjuge ou firmar pessoalmente o contrato de promessa de compra e venda do referido imóvel até o dia XX de maio de 20XX
            
             
            
            O  cônjuge virago se compromete, ainda, a firmar a escritura pública de compra e venda em data a ser designada pelo cônjuge.
            
             
            
            Cláusula Quarta: Da irrevogabilidade
            
             
            
            O presente termo de compromisso é firmado em caráter irrevogável e irretratável, sujeitando-se a parte inadimplente ao pagamento de perdas e danos.
            
             
            
             
            
            Por estarem justas e contratadas, celebram o presente termo de compromisso em duas vias de igual teor e forma, na presença de duas testemunhas.',
        ]);

        \App\Termo::create([
            'nome' => 'h1n1',
            'desc' => 'Pelo presente instrumento particular, XXXXXXXXX e XXXXXXXXXX, casados entre si em regime de comunhão parcial de bens, resolvem celebrar o presente termo de compromisso de acordo com as cláusulas e condições a seguir  determinadas:

 

            Cláusula Primeira: Do objeto:
            
             
            
            O objeto do presente termo de compromisso é a celebração do contrato de compra e venda de bem imóvel rural de propriedade do casal inscrito no NIRF sob o n. XXXXXXX, situado na cidade de Brumadinho/MG no local denominado Córrego da Alma, com área total de XXXX.
            
             
            
            Cláusula Segunda: Do preço:
            
             
            
            O valor integral recebido pelo casal com a venda do imóvel referido na cláusula anterior será depositado em uma conta poupança, que só poderá ser movimentada pelo casal conjuntamente.
            
             
            
            Cláusula Terceira: Das obrigações:
            
             
            
            O  cônjuge virago se compromete a firmar instrumento público de procuração em favor do cônjuge ou firmar pessoalmente o contrato de promessa de compra e venda do referido imóvel até o dia XX de maio de 20XX
            
             
            
            O  cônjuge virago se compromete, ainda, a firmar a escritura pública de compra e venda em data a ser designada pelo cônjuge.
            
             
            
            Cláusula Quarta: Da irrevogabilidade
            
             
            
            O presente termo de compromisso é firmado em caráter irrevogável e irretratável, sujeitando-se a parte inadimplente ao pagamento de perdas e danos.
            
             
            
             
            
            Por estarem justas e contratadas, celebram o presente termo de compromisso em duas vias de igual teor e forma, na presença de duas testemunhas.',
        ]);
    }
}
