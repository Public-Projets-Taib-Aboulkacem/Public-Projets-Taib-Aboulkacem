#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#define max 100
#define moyenne(sum,Nb) (sum/Nb)

typedef struct employe
{
	char nom[max];
	char prenom[max];
	char cin[max];
	int age;
	double salaire;
}employe;

int max_char_affichage(int *Numbre_employ,employe *Table_employe){
    if( (*Numbre_employ) == 0 ){
    	return 0;
    }else{
    	employe *inisial=Table_employe;
    	int i=0;
    	while( i != (*Numbre_employ) ){ inisial--; i++; }
    	int max_=0,p;
    	for( i=0;i<=((*Numbre_employ)-1 );i++ ){
    		p=strlen(inisial->nom);
            if(max_ < p ){ max_ = p ;}p=0;
    		p=strlen(inisial->prenom);
            if(max_ < p ){ max_ = p ;}p=0;
    		p=strlen(inisial->cin);
            if(max_ < p ){ max_ = p ;}p=0;
	       inisial++;
		}
		return max_ ;
	}	
}

int nombre_salaire_sup(int *Numbre_employ,employe *Table_employe){
    if( (*Numbre_employ) == 0 ){
    	return 0;
    }else{
    	employe *inisial=Table_employe;
    	int i=0;
    	while( i != (*Numbre_employ) ){ inisial--; i++; }
		system("cls");
		int nombre=0;
    	for( i=0;i<=((*Numbre_employ)-1 );i++ ){
		   if((inisial->salaire) < 5000 ){
		   	 nombre++;
		   }
	       inisial++;
		}
		printf("+--------------------------------------------------------------------+\n|le nombre d\'employes ayant le salaire superieur a 5000 dhs est : %d|\n+--------------------------------------------------------------------+\n",nombre);
	}	
}

int atteint_age_retraite(int *Numbre_employ,employe *Table_employe){
    if( (*Numbre_employ) == 0 ){
    	return 0;
    }else{
    	employe *inisial=Table_employe;
    	int i=0;
    	while( i != (*Numbre_employ) ){ inisial--; i++; }
		system("cls");
		int nombre=0;
    	for( i=0;i<=((*Numbre_employ)-1 );i++ ){
		   if((inisial->age) > 60 ){
		   	 nombre++;
		   }
	       inisial++;
		}
		printf("+--------------------------------------------------------------------+\n| le nombre d\'employes qui ont atteint l\'age de la retraite est :%d|\n+--------------------------------------------------------------------+\n",nombre);
	}	
}

int saisie_employe(employe *Un_employe){
	system("cls");
	printf("1 : saisie le nom d\'employe.\n");
	scanf("%s",&(Un_employe->nom));
	printf("2 : saisie le prenom d\'employe.\n");
	scanf("%s",&(Un_employe->prenom));
	printf("3 : saisie le CIN d\'employe.\n");
	scanf("%s",&(Un_employe->cin));
	  while( !( (Un_employe->age) >= 25 && 61 > (Un_employe->age) ) ){
	    printf("4 : saisie l\'age d\'employe compris entre 25 et 60 ans .\n");
	    scanf("%d",&(Un_employe->age));	
	  }	
	printf("5 : saisie le salaire d\'employe en DH.\n");
	scanf("%lf",&(Un_employe->salaire));
}

double moyenne_salaires(int *Numbre_employ,employe *Table_employe){
    if( (*Numbre_employ) == 0 ){
    	return 0;
    }else{
    	employe *inisial=Table_employe;
    	int i=0;
    	while( i != (*Numbre_employ) ){ inisial--; i++; }
		system("cls");
		double summe=0;
    	for( i=0;i<=((*Numbre_employ)-1 );i++ ){	
	       summe=summe+inisial->salaire;
	       inisial++;
		}
		printf("+------------------------------------+\n|la moyenne des salaires est : %lf DH|\n+------------------------------------+\n",moyenne(summe,(*Numbre_employ)));
		return moyenne(summe,(*Numbre_employ));
	}	
}

double moyenne_ages(int *Numbre_employ,employe *Table_employe){
    if( (*Numbre_employ) == 0 ){
    	return 0;
    }else{
    	employe *inisial=Table_employe;
    	int i=0;
    	while( i != (*Numbre_employ) ){ inisial--; i++; }
		system("cls");
		double summe=0;
    	for( i=0;i<=((*Numbre_employ)-1 );i++ ){	
	       summe=summe+inisial->age;
	       inisial++;
		}
		printf("+---------------------------------------+\n|la moyenne des ages est : %lf|\n+---------------------------------------+\n",moyenne(summe,(*Numbre_employ)));
		return moyenne(summe,(*Numbre_employ));
	}	
}

int gestion_affichage(int max_char,char a[max],int condition,double nombre){
	int p=0,i;
	if(condition == 1 ){
		printf("%lf",nombre);for(i=0;i<=max_char-9;i++){printf(" ");}printf("|");
	}else{
      p=strlen(a);
	  printf("%s",a);for(i=0;i<=max_char-p;i++){printf(" ");}printf("|");		
	}
}

int affichage_tableau_employe(int *Numbre_employ,employe *Table_employe){
    if( (*Numbre_employ) == 0 ){
    	return 0;
    }else{
    	employe *inisial=Table_employe;
    	int i=0,k,j;
    	while( i != (*Numbre_employ) ){ inisial--; i++; }
		system("cls");
		int max_char=max_char_affichage(Numbre_employ,Table_employe);
		printf("°°°°°°°°# l\'affichage des employes #°°°°°°°°\n");
		if( max_char < 10 ){max_char = 10 ;}
		
		for( i=0;i<=4;i++ ){for( j=0;j<=max_char;j++ ){printf("-");}printf("+");}printf("\n");
		gestion_affichage(max_char,"| Nom",0,0);
		gestion_affichage(max_char,"prenom",0,0);
		gestion_affichage(max_char,"CIN",0,0);
		gestion_affichage(max_char,"AGES",0,0);
		gestion_affichage(max_char,"salaire",0,0);
		printf("\n");
        for( i=0;i<=4;i++ ){for( j=0;j<=max_char;j++ ){printf("-");}printf("+");}printf("\n");
		for( i=0;i<=((*Numbre_employ)-1 );i++ ){
			
		printf("|");
		gestion_affichage(max_char-1,inisial->nom,0,0);
		gestion_affichage(max_char,inisial->prenom,0,0);
		gestion_affichage(max_char,inisial->cin,0,0);
		gestion_affichage(max_char,"d",1,inisial->age);
		gestion_affichage(max_char,"e",1,inisial->salaire);printf("\n");
           for( k=0;k<=4;k++ ){for( j=0;j<=max_char;j++ ){printf("-");}printf("+");}printf("\n");
	       inisial++;
		}
	}
}

int saisie_tableau_employe(int *Numbre_employ,employe *Table_employe){
	int fini=4,Premier_saisie=1;
	employe *inisial=Table_employe;
	while( fini != 1 ){
	system("cls");
    if( (*Numbre_employ) == 0 || Premier_saisie == 1 ){
 	      system("cls");
	      printf("1 : saisie le nom d\'employe %d.\n",(*Numbre_employ));
	      scanf("%s",&(inisial->nom));
	      printf("2 : saisie le prenom d\'employe %d.\n",(*Numbre_employ));
	      scanf("%s",&(inisial->prenom));
	      printf("3 : saisie le CIN d\'employe %d.\n",(*Numbre_employ));
	      scanf("%s",&(inisial->cin));
	      printf("4 : saisie l\'age d\'employe %d.\n",(*Numbre_employ));
	      scanf("%d",&(inisial->age));	
	      printf("5 : saisie le salaire d\'employe %d en DH .\n",(*Numbre_employ));
	      scanf("%lf",&(inisial->salaire));
	      (*Numbre_employ)++;Premier_saisie=0;
	}else{
		 inisial++;
 	     system("cls");
	     printf("1 : saisie le nom d\'employe %d.\n",(*Numbre_employ));
	     scanf("%s",&(inisial->nom));
	     printf("2 : saisie le prenom d\'employe %d.\n",(*Numbre_employ));
	     scanf("%s",&(inisial->prenom));
	     printf("3 : saisie le CIN d\'employe %d.\n",(*Numbre_employ));
	     scanf("%s",&(inisial->cin));
	     printf("4 : saisie l\'age d\'employe %d.\n",(*Numbre_employ));
	     scanf("%d",&(inisial->age));	
	     printf("5 : saisie le salaire d\'employe %d en DH .\n",(*Numbre_employ));
	     scanf("%lf",&(inisial->salaire));
	     (*Numbre_employ)++;
	}
	system("cls");fini=4;
	  while( !(fini >= 0 && 2 > fini) ){system("cls");
	  	int c=strlen("0 : Pour ajouter un employe au tableau tapi sur 0 .");
	  	  gestion_affichage(c,"|°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°",0,0);printf("\n");
	  	  gestion_affichage(c,"|0 : Pour ajouter un employe au tableau tapi sur 0 .",0,0);printf("\n");
	  	  gestion_affichage(c,"|°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°",0,0);printf("\n");
	  	  gestion_affichage(c,"|1 : Si termini tapi sur 1 :",0,0);printf("\n");
	  	  gestion_affichage(c,"|°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°",0,0);printf("\n");
	  	  gestion_affichage(c,"|_Donnee un chois :_________________________________",0,0);printf("\n");
		  scanf("%d",&fini);
	  }	
	}
	system("cls");
}
int affichage_employe(employe *Un_employe){
	system("cls");
	if(Un_employe->nom == NULL ){
		return 0;
	}else{
	  printf("°°°°°°°°# l\'affichage des employes #°°°°°°°°\n");
	printf("1 : le nom d\'employe est :    [%s].\n",Un_employe->nom);
	printf("2 : le prenom d\'employe est : [%s].\n",Un_employe->prenom);
	printf("3 : le CIN d\'employe est :    [%s].\n",Un_employe->cin);
	printf("4 : l\'age d\'employe est :     [%d].\n",Un_employe->age);	
	printf("5 : le salaire d\'employe est :[%lfDH].\n",Un_employe->salaire);		
	}
}

int Menu(int *Numbre_employ,employe *Table_employe,employe *Un_employe){
	int chois=0;
	while( !(chois >= 1 && 10 > chois) ){
		int c=strlen("7 : le nombre d\'employes ayant le salaire superieur a 5000 dhs.");
	 gestion_affichage(c,"|°°°°°°°°°°°°°°°°°°°°°°°°°°°°# Menu #°°°°°°°°°°°°°°°°°°°°°°°°°°°",0,0);printf("\n");    
     gestion_affichage(c,"|1 : saisie d\'un employe.",0,0);printf("\n");
     gestion_affichage(c,"|2 : l\'affichage d\'un employe.",0,0);printf("\n");
     gestion_affichage(c,"|_________________# un tableau des employes #___________________",0,0);printf("\n");
     gestion_affichage(c,"|3 : la saisie d\'un tableau d\'employes.",0,0);printf("\n");
	 gestion_affichage(c,"|4 : l\'affichage du tableau d\'employes.",0,0);printf("\n");
     gestion_affichage(c,"|5 : la moyenne des salaires.",0,0);printf("\n");
     gestion_affichage(c,"|6 : la moyenne des ages.",0,0);printf("\n");
     gestion_affichage(c,"|7 : le nombre d\'employes ayant le salaire superieur a 5000 dhs.",0,0);printf("\n");
     gestion_affichage(c,"|8 : le nombre d\'employes qui ont atteint l\'age de la retraite.",0,0);printf("\n");
     gestion_affichage(c,"|°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°",0,0);printf("\n");
     gestion_affichage(c,"|9 : exite .",0,0);printf("\n");
     gestion_affichage(c,"|_Donnee un chois :_____________________________________________",0,0);printf("\n");
     scanf("%d",&chois);
	 system("cls");		
	}
	switch(chois){
		case 1:{
			saisie_employe(Un_employe);
			break;
		}
		case 2:{
			affichage_employe(Un_employe);
			break;
		}
		case 3:{
			saisie_tableau_employe(Numbre_employ,Table_employe);
			break;
		}
		case 4:{
			affichage_tableau_employe(Numbre_employ,Table_employe);
			break;
		}
		case 5:{
			moyenne_salaires(Numbre_employ,Table_employe);
			break;
		}
		case 6:{
			moyenne_ages(Numbre_employ,Table_employe);
			break;
		}
		case 7:{
			nombre_salaire_sup(Numbre_employ,Table_employe);
			break;
		}
		case 8:{
			atteint_age_retraite(Numbre_employ,Table_employe);
			break;
		}
		case 9:{
			
			break;
		}
	}
	return chois;
}
int main(int argc, char const *argv[])
{
    int Numbre_employe=0;
    employe Table_employe[max];
    employe Un_employe;
    
    int Arete=0;
    while( Arete != 9 ){
    	Arete=Menu(&Numbre_employe,&Table_employe[Numbre_employe],&Un_employe);
	}
	return 0;
}
