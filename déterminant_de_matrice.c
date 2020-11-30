/*
Nom : Taib Aboulakcem.
*/
#include <stdio.h>
#include <stdlib.h>
#include <math.h>
int main(){
 int det=0,n=0,maxi,maxj,i,j;
 
 printf("Donnee le nombre de i puit j de vetre matrice :");scanf("%d%d",&maxi,&maxj);
 int T[maxi][maxj];
 printf("\nDonne vetre matrice :\n 1 0 0 0 \n0 1 0 0\n0 0 1 0\n0 0 0 1\nComme ce si exemple :\n");
 for(i=0;i<maxi;i++){
 	for(j=0;j<maxj;j++){
 		scanf("%d",&T[i][j]);
	 }
 }
 int *v;
 v=T;
 det=deter(v,maxi,maxj);
 printf("det=%d",det);
 //so(p);
}
//______________________
int deter(int *M,int maxi,int maxj){
	int j_deP=0,i_deP=0,l,k,i,j,Y[10][10],ret=0,maxj1,maxi1;
	int *P,*H,*N;
	P=M;H=M;
	pr(P,maxi);
	if(maxi == 2 && maxj == 2 ){
		printf("%d * %d - %d * %d = %d \n",(*P),(*(P+3)),*(P+1),(*(P+2)),( (*P)*(*(P+3)) - (*(P+1))*(*(P+2)) ));
	  ret = ( (*P)*(*(P+3)) - (*(P+1))*(*(P+2)) );	
	}else{
		if(maxi==maxj){
		i=0;
		 for(j=0;j<maxj;j++){i_deP=0;P=M;
			for(k=0;k<maxi;k++){
			 j_deP=0;
				for(l=0;l<maxj;l++){
					  if( k != i && j != l){
					  	printf("i=%d;j=%d,*p=%d\n",i,j,*P);
					    Y[i_deP][j_deP]=*P;	
					    printf("i=%d;j=%d,[i,j]=%d\n",i_deP,j_deP,Y[i_deP][j_deP]);
					  }	
					  if( j != l) j_deP++;
					  P++;
					  maxj1=j_deP;
				}
			 if( k != i ) i_deP++;
			 maxi1=i_deP;
			}
			N=Y;
			ret=ret+(pow(-1,(i+j))*(*H)*deter(N,maxi1,maxj1));
		 H++;
		 }			
		}
	}
	return ret;
}
