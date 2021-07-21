# Framework phpHunter

<small>Web Developers</small>
<hr />
Website: www.phphunter.com.br
<hr />

# Especificação Técnica e Requisitos

- HTML5
- CSS3
- PHP7
- jsHunter (javascript library)
- Shellscript (phpHunter creator)
- Idiomas: PT-BR, EN, ES
- MVC
- Composer

# Principais Comandos

<pre>
!HELPER, use: ./bin/phpHunter --help
./bin/phpHunter [command {[options...]}

    --init [sample, .env, application, etc...] - Initialize the framework
    --remove - Remove the framework
    --refresh - Update project (reload all features)
    --lock - Lock application (maintenance mode)
    --unlock - Unlock application
    --help - Show all commands and helpers to use phpHunter Framework

    (To commands below please, see Documentation on GitHub)
    create:api
    delete:api
    lock:api
    unlock:api
    create:app
    delete:app
    lock:app
    unlock:app
    create:resource
    delete:resource
    lock:resource
    unlock:resource
    create:content
    delete:content
    lock:content
    unlock:content
    create:item
    delete:item
    lock:item
    unlock:item
</pre>

# Inicializando o framework

<hr />
<h3>INIT</h3>
<pre>
./bin/phpHunter --init
</pre>
<p>
O comando acima ira iniciar toda a estrutura do framework, criando as pastas e arquivos necessários para visualizar um exemplo de aplicação em tela.
</p>

<p>Para inicializar o framework, você pode informar um arquivo válido .env, um path qualquer (por exemplo: documentation) ou a palavra chave sample, que nesse utimo caso ira criar uma estrutura de exemplo para uso da aplicação atual e o nome da pasta principal (MAIN DIR) será application.</p>

<p>Para remover a instalação use o seguinte comando:</p>

<pre>./bin/phpHunter --remove</pre>

# Convenção e Estrutura do site (framework phpHunter)

O site jshunter-lib possui um formato particular e referente ao framework phpHunter, simples, organizado e gerenciavel por CLI (script em shellscript) que atende pelos comandos descritos abaixo.
<br />
A estrutura de pastas do site consiste no seguinte aspecto:
<pre>
api/
app/
bin/
downloads/
resources/
node_modules/
index.php
package-lock.json
README.md
.env
.htaccess
</pre>

<h4>Pasta api</h4>
<p>A pasta api/ existe com o unico propósito de expor as APIs do sistema, sendo elas separadas por pastas (endpoints) servidas através de scripts raiz em PHP (index)</p>

<h4>Pasta app</h4>
<p>Todos os controles e recursos do sistema para gerenciamento e automação dos processos ficam nessa pasta, como a classe AppHandler que é responsavel por gerenciar todo acesso e manipulação durante a navegação no site. Quando um app é criado, ele é salvo na pasta app/source, servindo ao sistema de qualquer forma ou local a ser chamado.</p>

<h4>Pasta bin</h4>
<p>A pasta bin contem todos os scripts responsaveis por gerenciar o conteudo do site, sendo esses script escritos em shellscript. Veja abaixo como eles podem ser utilizados para otimizar o tempo de desenvolvimento.</p>

<h4>Pasta downloads</h4>
<p>Na pasta downloads devem ser colocados recursos que serão utilizados e disponibilizados para downloads no site, como por exemplo a biblioteca jshunter e seus derivados, no formato ZIP.</p>

<h4>Pasta node_modules</h4>
<p>A pasta node_modules/ contem os scripts e modulos javascript, e nesse framework é disponibilizado a opção de usar a biblioteca parceiro do framework, chamada jsHunter.</p>

<h4>Pasta resources</h4>
<p>Essa é a pasta mais importante do framework, contem todos os recursos e configurações do sistema, como segue abaixo:</p>
<pre>
css/ (Arquivos de estilos do framework)
js/ (Scripts em JS)
data/
    /access (Local onde esta armazenado o contador de visitas)
application/ (Pasta da aplicação de exemplo)
    database/ (Pasta que guarda os arquivos html da aplicação)
    extensions/ (Conteudo adicional ao site)
    site/ (Pasta onde ficam os conteudos do site)
engine/ (Motor da aplicação, para apresentar os dados em tela)
images/
maintenance/ (Pasta para definição de site em manutenção)
public/ (Pasta padrão para arquivo gateway do framework)
shared/ (Local onde estão contidos os arquivos para alertas informativos)
    alerts/
</pre>

<p>Como é de se esperar as pastas images, css e js contem os recursos refentes aos estilos visuais, funcionalidades em scripts js e imagens</p>

<h5>IMPORTANTE</h3>
<p>A pasta data/ não deve ser alterada pois ele guarda dados do sistema, como quantidade de visualiazções na pagina.</p>

<p>A pasta application contem o conteúdo do aplicação (todos os conteudos) por isso merece uma atenção maior. Essa pasta pode ter qualquer outro nome, é possivel criar várias aplicações em paralelo seguindo o conceito de módulos, ou até mesmo criar vários conteúdos dentro de um mesmo diretórios de aplicação.</p>

# Comandos para criação e gerenciamento de conteudo

<hr />
<h3>API HANDLER</h3>
<pre>
./bin/phpHunter {create|delete|lock|unlock}:api {ApiFolderName}:{api-name}
./bin/phpHunter create:api login:login-control
./bin/phpHunter delete:api login:login-control
./bin/phpHunter lock:api login:login-control
./bin/phpHunter unlock:api login:login-control
</pre>

<hr />
<h3>APP HANDLER</h3>
<pre>
./bin/phpHunter {create|delete|lock|unlock}:app {SourceName}
./bin/phpHunter create:app AppHandler
./bin/phpHunter delete:app AppHandler
./bin/phpHunter lock:app AppHandler
./bin/phpHunter unlock:app AppHandler
</pre>

<hr />
<h3>RESOURCE HANDLER</h3>
<pre>
./bin/phpHunter {create|delete|lock|unlock}:resource {ResourceType: [engine|content]} {ResourceTarget: [site|extension]/target}
./bin/phpHunter create:resource content site/target
./bin/phpHunter delete:resource content site/target
./bin/phpHunter lock:resource content site/target
./bin/phpHunter unlock:resource content site/target
</pre>
<h6>[CREATE]</h6>
Para criar um conteudo, primeiro crie a base onde o conteudo ficara armazenado:
<pre>
./bin/phpHunter create:resource content site/target
</pre>
Caso queira preparar uma base de dados em arquivos para o recurso use o comando:
<pre>
./bin/phpHunter create:resource content database/site
</pre>
<h6>[DELETE]</h6>
Para apagar um recurso e seu conteudo use o comando abaixo:
<pre>
./bin/phpHunter delete:resource content site/target
</pre>
<h6>[LOCK]</h6>
Para bloquear um recurso e seu conteudo:
<pre>
./bin/phpHunter lock:resource content site/target
</pre>
<h6>[UNLOCK]</h6>
Para desbloquear um recurso e seu conteudo:
<pre>
./bin/phpHunter unlock:resource content site/target
</pre>

<hr />
<h3>CONTENT HANDLER</h3>
<pre>
./bin/phpHunter {create|delete|lock|unlock}:content {ResourceName} {Content-Name} {CreateDatabase: [db:true|db:false]} {Contents: [content1:content2:...]}
./bin/phpHunter create:content site/target Content-Name-Test db:true function1:test1:others
./bin/phpHunter delete:content site/target Content-Name-Test db:true
./bin/phpHunter lock:content site/target Content-Name-Test
./bin/phpHunter unlock:content site/target Content-Name-Test
</pre>
<h6>[CREATE]</h6>
Apos criar a base do conteudo use o comando abaixo para gerar os conteudos que serão colocados em cada recurso criado acima:
<pre>
./bin/phpHunter create:content site/target Content-Name-Test db:true
function1:test1:others
</pre>
<h6>[DELETE]</h6>
Para apagar apenas o conteudo de um recurso use o comando abaixo:
<pre>
./bin/phpHunter delete:content site/target Content-Name-Test db:true
</pre>
<h6>[LOCK]</h6>
<pre>
./bin/phpHunter lock:content site/target Content-Name-Test
</pre>
<h6>[UNLOCK]</h6>
<pre>
./bin/phpHunter unlock:content site/target Content-Name-Test
</pre>

<hr />
<h3>ITEM HANDLER</h3>
<pre>
./bin/phpHunter {create|delete|lock|unlock}:item {ResourceName} {Content-Name} {CreateDatabase: [db:true|db:false]} {itemName}
./bin/phpHunter create:item site/target Content-Name-Test db:true newItem
./bin/phpHunter delete:item site/target Content-Name-Test db:true newItem
./bin/phpHunter lock:item site/target Content-Name-Test db:true newItem
./bin/phpHunter unlock:item site/target Content-Name-Test db:true newItem
</pre>
<h6>[CREATE]</h6>
Para adicionar um item a um conteudo ja criado:
<pre>
./bin/phpHunter create:item site/target Content-Name-Test db:true newItem
</pre>
<h6>[DELETE]</h6>
Para remover um item de um conteudo:
<pre>
./bin/phpHunter delete:item site/target Content-Name-Test db:true newItem
</pre>
<h6>[LOCK]</h6>
Para bloquear um item de um conteudo:
<pre>
./bin/phpHunter lock:item site/target Content-Name-Test db:true newItem
</pre>
<h6>[UNLOCK]</h6>
Para desbloquear um item de um conteudo:
<pre>
./bin/phpHunter unlock:item site/target Content-Name-Test db:true newItem
</pre>
