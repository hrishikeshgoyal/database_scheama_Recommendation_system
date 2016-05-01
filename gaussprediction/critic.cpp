#include<iostream>
#include<time.h>

#include<stdlib.h>
#include<stdio.h>
using  namespace std;

int arr[10];

int main () {

	int tcount=rand();
	tcount %= 15;

	srand(time(NULL));

	for (int i=0;i<20;i++) {



		arr[9]=1;

		arr[1]=tcount+rand()%10;

		arr[2]=1+rand()%10;

		arr[7]=1+rand()%3;
		arr[3]=0;
		arr[4]==rand() %5;
		arr[5]=0;
		arr[6]=0;
		arr[8]=0;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";

		cout<<endl;
	}



	for (int i=0;i<20;i++) {


		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


        arr[9]=5;

		arr[1]=tcount+rand()%10;

		arr[2]=1+rand()%10;

		arr[7]=1+rand()%3;


		arr[3]=0;
		arr[4]=rand() %5;
		arr[5]=0;
		arr[6]=0;
        arr[8]=0;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";

		cout<<endl;
	}

	for (int i=0;i<20;i++) {


		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


		arr[9]=2;

		arr[1]=tcount+rand()%10;

		arr[2]=1+rand()%10;

		arr[7]=1+rand()%3;


		arr[3]=0;
		arr[4]=1+ rand()%10;
		arr[5]=0;
		arr[6]=0;

		arr[8]=0;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";



		cout<<endl;
	}


	for (int i=0;i<20;i++) {


		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


		arr[9]=1;

		arr[1]=tcount+rand()%10;
		arr[3]=1+rand()%10;
		arr[2]=0;

		arr[7]=0;


		arr[4]=0;
		arr[5]=0;
		arr[6]=0;

		arr[8]=0;
		cout<<"array(0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";


		cout<<endl;
	}


	for (int i=0;i<20;i++) {


		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


		arr[9]=3;

		arr[1]=tcount+rand()%10;
		arr[3]=1+rand()%10;
		arr[2]=0;

		arr[7]=0;


		arr[4]=0;
		arr[5]=0;
		arr[6]=0;

		arr[8]=0;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";



		cout<<endl;
	}

	for (int i=0;i<20;i++) {


		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


		arr[9]=4;

		arr[1]=tcount+rand()%10;
		arr[3]=1+rand()%10;
		arr[2]=0;

		arr[7]=0;


		arr[4]=0;
		arr[5]=0;
		arr[6]=0;

		arr[8]=0;
		cout<<"array(0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";


		cout<<endl;
	}


    for (int i=0;i<20;i++) {


		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


		arr[9]=4;

		arr[1]=0;//tcount+rand()%10;
		arr[3]=0;
		arr[2]=0;

		arr[7]=0;


		arr[4]=0;
		arr[5]=5+rand()% 10;
		arr[6]=0;

		arr[8]=1+ rand () %50;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";


		cout<<endl;
	}

    for (int i=0;i<20;i++) {


		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


		arr[9]=5;

		arr[1]=0;//tcount+rand()%10;
		arr[3]=0;
		arr[2]=0;

		arr[7]=0;


		arr[4]=0;
		arr[5]=5+rand()% 10;
		arr[6]=0;

		arr[8]= 1+rand () %50;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";


		cout<<endl;
	}



    for (int i=0;i<20;i++) {

		for (int j=1;j<=8;j++) {

			arr[j]=0;
		}


		arr[9]=4;

		arr[1]=0;//tcount+rand()%10;
		arr[3]=0;
		arr[2]=0;

		arr[7]=0;


		arr[4]=0;
		arr[5]=0;
		arr[6]=10 + rand()%20;

		arr[8]=0;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";


		cout<<endl;
	}

	for (int i=0;i<20;i++) {

        for (int j=1;j<=8;j++) {

            arr[j]=0;
		}


		arr[9]=5;

		arr[1]=0;//tcount+rand()%10;
		arr[3]=0;
		arr[2]=0;

		arr[7]=0;


		arr[4]=0;
		arr[5]=0;
		arr[6]=10 + rand()%20;

		arr[8]=0;
		cout<<"array( 0,";
		for (int j=1;j<=8;j++) {

			cout<<arr[j]<<",";
		}
		cout<<arr[9]<<"),";


		cout<<endl;
	}



}
