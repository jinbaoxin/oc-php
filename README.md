## PHP on Openshift
> Assuming you have a OCP cluster ready.

#### Create new project
`oc new-project php-example`

#### Create new php application using source 2 image process
`oc new-build php:5.6~https://github.com/debianmaster/php-welcome --name=myphp`   
> i.e.  create an application image with php:5.6 as base and source code provided in git repo 

#### Create a pipe line Piepiline example 
`oc new-app jenkins-ephemeral`  #Create jenkins instance in your project if not created already.
`oc create -f sample-pipeline.yml -n php-example`   

```yml
apiVersion: v1
kind: BuildConfig
metadata:
  name: sample-pipeline
  labels:
    app: jenkins-pipeline-example
    name: sample-pipeline
    template: application-template-sample-pipeline
  annotations:
    pipeline.alpha.openshift.io/uses: '[{"name": "myphp", "namespace": "", "kind": "DeploymentConfig"}]'
spec:
  runPolicy: Serial
  source:
    type: None
  strategy:
    type: JenkinsPipeline
    jenkinsPipelineStrategy:
      jenkinsfile: "node {\nstage 'build'\nopenshiftBuild(buildConfig: 'myphp', showBuildLogs: 'true')\nstage 'deploy'\nopenshiftDeploy(deploymentConfig: 'myphp')\n}"
  ```
#### Trigger pipeline
`oc start-build sample-pipeline`


